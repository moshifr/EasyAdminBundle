<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Inspector;

use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Provider\AdminContextProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector as BaseDataCollector;

/**
 * Collects information about the requests related to EasyAdmin and displays
 * it both in the web debug toolbar and in the profiler.
 *
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class DataCollector extends BaseDataCollector
{
    private $adminContextProvider;

    public function __construct(AdminContextProvider $adminContextProvider)
    {
        $this->adminContextProvider = $adminContextProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->data = [];
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, $exception = null)
    {
        if (null === $context = $this->adminContextProvider->getContext()) {
            return;
        }

        $collectedData = [];
        foreach ($this->collectData($context) as $key => $value) {
            $collectedData[$key] = $this->cloneVar($value);
        }

        $this->data = $collectedData;
    }

    public function isEasyAdminRequest(): bool
    {
        return !empty($this->data);
    }

    public function getData(): array
    {
        return $this->data;
    }

    private function collectData(AdminContext $context): array
    {
        return [
            'CRUD Controller' => $context->getRequest()->get('crudController'),
            'CRUD Action' => $context->getRequest()->get('crudAction'),
            'Entity Id' => $context->getRequest()->get('entityId'),
            'Sort' => $context->getRequest()->get('sort'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'easyadmin';
    }
}
