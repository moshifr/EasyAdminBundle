<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Collection;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Collection\CollectionInterface;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
final class FieldCollection implements CollectionInterface
{
    /** @var FieldDto[] */
    private $fields;

    /**
     * @param FieldInterface[]|string[] $fields
     */
    private function __construct(iterable $fields)
    {
        $this->fields = $this->processFields($fields);
    }

    public function __clone()
    {
        foreach ($this->fields as $fieldName => $fieldDto) {
            $this->fields[$fieldName] = clone $fieldDto;
        }
    }

    /**
     * @param FieldInterface[]|string[] $fields
     */
    public static function new(iterable $fields): self
    {
        return new self($fields);
    }

    public function get(string $fieldName): ?FieldDto
    {
        return $this->fields[$fieldName] ?? null;
    }

    public function set(FieldDto $newOrUpdatedField): void
    {
        $this->fields[$newOrUpdatedField->getProperty()] = $newOrUpdatedField;
    }

    public function offsetExists($offset): bool
    {
        return \array_key_exists($offset, $this->fields);
    }

    public function offsetGet($offset)
    {
        return $this->fields[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->fields[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->fields[$offset]);
    }

    public function count(): int
    {
        return \count($this->fields);
    }

    /**
     * @return \ArrayIterator|\Traversable|FieldDto[]
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->fields);
    }

    /**
     * @param FieldInterface[]|string[] $fields
     *
     * @return FieldDto[]
     */
    private function processFields(iterable $fields): array
    {
        $dtos = [];

        // for DX reasons, fields can be configured as a FieldInterface object and
        // as a simple string with the name of the Doctrine property
        /** @var FieldInterface|string $field */
        foreach ($fields as $field) {
            if (\is_string($field)) {
                $field = Field::new($field);
            }

            $dto = $field->getAsDto();
            $dto->setFieldFqcn(\get_class($field));
            $dtos[$dto->getProperty()] = $dto;
        }

        return $dtos;
    }
}
