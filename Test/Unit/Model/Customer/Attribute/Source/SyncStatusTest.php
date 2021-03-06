<?php
/**
 * Copyright © 2016 TechNWeb, Inc. All rights reserved.
 * See TNW_LICENSE.txt for license details.
 */

namespace TNW\QuickbooksBasic\Test\Unit\Model\Customer\Attribute\Source;

use TNW\QuickbooksBasic\Model\Customer\Attribute\Source\SyncStatus;

/**
 * Class SyncStatusTest
 * @package TNW\QuickbooksBasic\Test\Unit\Model\Customer\Attribute\Source
 */
class SyncStatusTest extends \PHPUnit_Framework_TestCase
{
    /** @var SyncStatus */
    protected $model;

    /**
     * Test for \TNW\QuickbooksBasic\Model\Customer\Attribute\Source\SyncStatus::getOptionText
     * @param $optionValue
     * @param $expectedResult
     *
     * @dataProvider getOptionTextDataProvider
     */
    public function testGetOptionText($optionValue, $expectedResult)
    {
        $this->assertEquals(
            $expectedResult,
            $this->model->getOptionText($optionValue)
        );
    }

    /**
     * Test for \TNW\QuickbooksBasic\Model\Customer\Attribute\Source\SyncStatus::getAllOptions
     * @param $expectedResult
     *
     * @dataProvider getAllOptionsDataProvider
     */
    public function testGetAllOptions($expectedResult)
    {
        $expectedResult = $this->proceedParsingObjectsData($expectedResult);
        $actualResult = $this->proceedParsingObjectsData(
            $this->model->getAllOptions()
        );
        $this->assertSame($expectedResult, $actualResult);
    }

    /**
     * Sets text from parsing object in option array
     * @param $options
     * @return array
     */
    private function proceedParsingObjectsData($options)
    {
        $result = [];
        foreach ($options as $option) {
            $result[] = [
                'label' => $option['label']->getText(),
                'value' => $option['value']
            ];
        }

        return $result;
    }

    /**
     * DataProvider for testGetOptionText
     * @return array
     */
    public function getOptionTextDataProvider()
    {
        if (!$this->model) {
            $this->model = new SyncStatus();
        }
        $options = $this->model->getAllOptions();
        $providerData = [];
        $i = 1;
        foreach ($options as $option) {
            $providerData['Case with option ' . $i] = [
                $option['value'],
                $option['label']
            ];
            $i++;
        }
        $providerData['Case with not valid option provided'] = [3, false];

        return $providerData;
    }

    /**
     * DataProvider for testGetAllOptions
     * @return array
     */
    public function getAllOptionsDataProvider()
    {
        return [
            'Options array' => [
                [
                    [
                        'label' => __('In Sync'),
                        'value' => SyncStatus::VALUE_SYNCED
                    ],
                    [
                        'label' => __('Out of Sync'),
                        'value' => SyncStatus::VALUE_UNSYNCED
                    ]
                ]
            ]
        ];
    }

    /**
     * Test tear down
     */
    public function tearDown()
    {
        $this->model = null;
    }

    /**
     * Test setup
     */
    protected function setUp()
    {
        if (!$this->model) {
            $this->model = new SyncStatus();
        }
    }
}
