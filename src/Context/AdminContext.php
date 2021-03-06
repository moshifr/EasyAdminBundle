<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Context;

use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Controller\DashboardControllerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\AssetsDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\CrudDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\DashboardDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\I18nDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\MainMenuDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\UserMenuDto;
use EasyCorp\Bundle\EasyAdminBundle\Factory\MenuFactory;
use EasyCorp\Bundle\EasyAdminBundle\Registry\CrudControllerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Registry\TemplateRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * A context object that stores all the state and config of the current admin request.
 *
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
final class AdminContext
{
    private $request;
    private $user;
    private $i18nDto;
    private $crudControllerRegistry;
    private $entityDto;
    private $dashboardDto;
    private $dashboardControllerInstance;
    private $assetDto;
    private $crudDto;
    private $searchDto;
    private $menuFactory;
    private $templateRegistry;
    private $mainMenuDto;
    private $userMenuDto;

    public function __construct(Request $request, ?UserInterface $user, I18nDto $i18nDto, CrudControllerRegistry $crudControllerRegistry, DashboardDto $dashboardDto, DashboardControllerInterface $dashboardController, AssetsDto $assetDto, ?CrudDto $crudDto, ?EntityDto $entityDto, ?SearchDto $searchDto, MenuFactory $menuFactory, TemplateRegistry $templateRegistry)
    {
        $this->request = $request;
        $this->user = $user;
        $this->i18nDto = $i18nDto;
        $this->crudControllerRegistry = $crudControllerRegistry;
        $this->dashboardDto = $dashboardDto;
        $this->dashboardControllerInstance = $dashboardController;
        $this->crudDto = $crudDto;
        $this->assetDto = $assetDto;
        $this->entityDto = $entityDto;
        $this->searchDto = $searchDto;
        $this->menuFactory = $menuFactory;
        $this->templateRegistry = $templateRegistry;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getReferrer(): ?string
    {
        return $this->request->query->get('referrer');
    }

    public function getI18n(): I18nDto
    {
        return $this->i18nDto;
    }

    public function getCrudControllers(): CrudControllerRegistry
    {
        return $this->crudControllerRegistry;
    }

    public function getEntity(): EntityDto
    {
        return $this->entityDto;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function getAssets(): AssetsDto
    {
        return $this->assetDto;
    }

    public function getDashboardTitle(): string
    {
        return $this->dashboardDto->getTitle();
    }

    public function getDashboardFaviconPath(): string
    {
        return $this->dashboardDto->getFaviconPath();
    }

    public function getDashboardRouteName(): string
    {
        return $this->dashboardDto->getRouteName();
    }

    public function getMainMenu(): MainMenuDto
    {
        if (null !== $this->mainMenuDto) {
            return $this->mainMenuDto;
        }

        $mainMenuItems = iterator_to_array($this->dashboardControllerInstance->configureMenuItems());
        $selectedMenuIndex = $this->request->query->getInt('menuIndex', -1);
        $selectedMenuSubIndex = $this->request->query->getInt('submenuIndex', -1);

        return $this->mainMenuDto = $this->menuFactory->createMainMenu($mainMenuItems, $selectedMenuIndex, $selectedMenuSubIndex);
    }

    public function getUserMenu(): UserMenuDto
    {
        if (null !== $this->userMenuDto) {
            return $this->userMenuDto;
        }

        if (null === $this->user) {
            return UserMenu::new()->getAsDto();
        }

        $userMenu = $this->dashboardControllerInstance->configureUserMenu($this->user);

        return $this->userMenuDto = $this->menuFactory->createUserMenu($userMenu);
    }

    public function getCrud(): ?CrudDto
    {
        return $this->crudDto;
    }

    public function getSearch(): ?SearchDto
    {
        return $this->searchDto;
    }

    public function getTemplatePath(string $templateName): string
    {
        return $this->templateRegistry->get($templateName);
    }
}
