<?php

namespace Iq500\Filters;

use Laravel\Nova\Filters\Filter;
use InvalidArgumentException;
use Iq500\Filters\Enums\Config;

abstract class MultiselectFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'multiselect-filter';

    public function __construct(array $configuration = [])
    {
        $this->configure($configuration);
    }

    protected function configure(array $configuration): void
    {
        if (empty($configuration)) {
            return;
        }

        foreach ($configuration as $property => $value) {
            if (!in_array($property, Config::getProperties(), true)) {
                throw new InvalidArgumentException('Invalid property: ' . $property);
            }

            $this->withMeta([$property => $value]);
        }
    }
}
