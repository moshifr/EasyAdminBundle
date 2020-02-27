<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Property;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Property\PropertyConfigInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AvatarProperty implements PropertyConfigInterface
{
    use PropertyConfigTrait;

    public const OPTION_IS_GRAVATAR_EMAIL = 'isGravatarEmail';
    public const OPTION_HEIGHT = 'height';

    public function __construct()
    {
        $this
            ->setType('avatar')
            ->setFormType(TextType::class)
            ->setTemplateName('property/avatar')
            ->setCustomOption(self::OPTION_IS_GRAVATAR_EMAIL, false)
            ->setCustomOption(self::OPTION_HEIGHT, null);
    }

    public function setHeight($heightInPixels): self
    {
        $semanticHeights = ['sm' => 18, 'md' => 24, 'lg' => 48, 'xl' => 96];

        if (!\is_int($heightInPixels) && !\in_array($heightInPixels, $semanticHeights)) {
            throw new \InvalidArgumentException(sprintf('The argument of the "%s()" method must be either an integer (the height in pixels) or one of these string values: %s (%d given).', __METHOD__, implode(', ', $semanticHeights), $heightInPixels));
        }

        if (\is_string($heightInPixels)) {
            $heightInPixels = $semanticHeights[$heightInPixels];
        }

        if ($heightInPixels < 1) {
            throw new \InvalidArgumentException(sprintf('When passing an integer for the argument of the "%s()" method, the value must be 1 or higher (%d given).', __METHOD__, $heightInPixels));
        }

        $this->setCustomOption(self::OPTION_HEIGHT, $heightInPixels);

        return $this;
    }

    public function setIsGravatarEmail(bool $isGravatar = true): self
    {
        $this->setCustomOption(self::OPTION_IS_GRAVATAR_EMAIL, $isGravatar);

        return $this;
    }
}