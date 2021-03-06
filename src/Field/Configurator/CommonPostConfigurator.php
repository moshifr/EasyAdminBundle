<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Field\Configurator;

use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldConfiguratorInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Provider\AdminContextProvider;
use function Symfony\Component\String\u;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
final class CommonPostConfigurator implements FieldConfiguratorInterface
{
    private $adminContextProvider;

    public function __construct(AdminContextProvider $adminContextProvider)
    {
        $this->adminContextProvider = $adminContextProvider;
    }

    public function supports(FieldDto $field, EntityDto $entityDto): bool
    {
        // this configurator applies to all kinds of properties
        return true;
    }

    public function configure(FieldDto $field, EntityDto $entityDto, AdminContext $context): void
    {
        $formattedValue = $this->buildFormattedValueOption($field->getFormattedValue(), $field, $entityDto);
        $field->setFormattedValue($formattedValue);

        $this->updateFieldTemplate($field);
    }

    private function buildFormattedValueOption($value, FieldDto $field, EntityDto $entityDto)
    {
        if (null === $callable = $field->getFormatValueCallable()) {
            return $value;
        }

        return $callable($value, $entityDto->getInstance());
    }

    private function updateFieldTemplate(FieldDto $field): void
    {
        $usesEasyAdminTemplate = u($field->getTemplatePath())->startsWith('@EasyAdmin/');
        $isBooleanField = BooleanField::class === $field->getFieldFqcn();
        $isNullValue = null === $field->getFormattedValue();
        $isEmpty = is_countable($field->getFormattedValue()) ? 0 === \count($field->getFormattedValue()) : false;

        $adminContext = $this->adminContextProvider->getContext();
        if ($usesEasyAdminTemplate && $isNullValue && !$isBooleanField) {
            $field->setTemplatePath($adminContext->getTemplatePath('label/null'));
        }

        if ($usesEasyAdminTemplate && $isEmpty) {
            $field->setTemplatePath($adminContext->getTemplatePath('label/empty'));
        }
    }
}
