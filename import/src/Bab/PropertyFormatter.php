<?php

namespace Bab;

class PropertyFormatter
{
    protected $forceArray = ['internet_access', 'note'];

    /**
     * create a multi dimensionnal array if property keys contains ":"
     *
     * @param array $properties
     *
     * @return array
     */
    public function format(array $properties)
    {
        $cleanedProperties = [];
        foreach ($properties as $key => $value) {
            if (false === strpos($key, ':')) {
                if (in_array($key, $this->forceArray)) {
                    $cleanedProperties[$key] = [
                        'value' => $value
                    ];
                } else {
                    $cleanedProperties[$key] = $value;
                }

                continue;
            }

            $parts = explode(':', $key);
            if (!isset($cleanedProperties[$parts[0]])) {
                $cleanedProperties[$parts[0]] = [];
            }

            $cleanedProperties[$parts[0]][$parts[1]] = $value;
        }

        return $cleanedProperties;
    }
}
