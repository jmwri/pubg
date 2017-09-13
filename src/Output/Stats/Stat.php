<?php

namespace JmWri\Pubg\Output\Stats;

/**
 * Class Stat
 * @package JmWri\Pubg\Output\Stats
 */
class Stat
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var null|int
     */
    protected $valueInt;

    /**
     * @var null|float
     */
    protected $valueDec;

    /**
     * @var null|string
     */
    protected $valueStr;

    /**
     * @var null|int
     */
    protected $rank;

    /**
     * @var float
     */
    protected $percentile;

    /**
     * @var string
     */
    protected $displayValue;

    /**
     * Stats constructor.
     *
     * @param [] $data
     */
    public function __construct($data)
    {
        $this->setLabel($data['label']);
        $this->setField($data['field']);
        $this->setCategory($data['category']);
        $this->setValueInt($data['ValueInt']);
        $this->setValueDec($data['ValueDec']);
        $this->setValueStr($data['value']);
        $this->setRank($data['rank']);
        $this->setPercentile($data['percentile']);
        $this->setDisplayValue($data['displayValue']);
    }

    /**
     * @return string
     *
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    protected function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    protected function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    protected function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return null|int
     */
    public function getValueInt()
    {
        return $this->valueInt;
    }

    /**
     * @param null|int $valueInt
     */
    protected function setValueInt($valueInt)
    {
        $this->valueInt = $valueInt;
    }

    /**
     * @return null|float
     */
    public function getValueDec()
    {
        return $this->valueDec;
    }

    /**
     * @param null|float $valueDec
     */
    protected function setValueDec($valueDec)
    {
        $this->valueDec = $valueDec;
    }

    /**
     * @return null|string
     */
    public function getValueStr()
    {
        return $this->valueStr;
    }

    /**
     * @param null|string $valueStr
     */
    protected function setValueStr($valueStr)
    {
        $this->valueStr = $valueStr;
    }

    /**
     * @return null|string
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param null|string $rank
     */
    protected function setRank($rank)
    {
        $this->rank = $rank;
    }

    /**
     * @return float
     */
    public function getPercentile()
    {
        return $this->percentile;
    }

    /**
     * @param float $percentile
     */
    protected function setPercentile($percentile)
    {
        $this->percentile = $percentile;
    }

    /**
     * @return string
     */
    public function getDisplayValue()
    {
        return $this->displayValue;
    }

    /**
     * @param string $displayValue
     */
    protected function setDisplayValue($displayValue)
    {
        $this->displayValue = $displayValue;
    }
}
