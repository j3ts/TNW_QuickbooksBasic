<?php
/**
 * Copyright © 2016 TechNWeb, Inc. All rights reserved.
 * See TNW_LICENSE.txt for license details.
 */

namespace TNW\QuickbooksBasic\Model\Customer\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

/**
 * Class SyncStatus
 * @package TNW\QuickbooksBasic\Model\Customer\Attribute\Source
 */
class SyncStatus extends AbstractSource
{
    /**
     * Value for synced state
     */
    const VALUE_SYNCED = 1;

    /**
     * Value for unsynced state
     */
    const VALUE_UNSYNCED = 0;

    /**
     * Get a text for option value
     *
     * @param string|int $value
     * @return string|false
     */
    public function getOptionText($value)
    {
        $options = $this->getAllOptions();
        foreach ($options as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }

        return false;
    }

    /**
     * Retrieve all options array
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('In Sync'), 'value' => self::VALUE_SYNCED],
                ['label' => __('Out of Sync'), 'value' => self::VALUE_UNSYNCED],
            ];
        }

        return $this->_options;
    }
}
