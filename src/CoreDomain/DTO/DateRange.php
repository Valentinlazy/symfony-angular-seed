<?php

namespace CoreDomain\DTO;

class DateRange
{
    /**
     * Far-future ISO-8601 date
     * @var string
     */
    const FUTURE = '9999-01-01';

    /**
     * Far-past ISO-8601 date
     * @var string
     */
    const PAST = '1000-01-01';

    private $dateFrom;
    private $dateTo;

    public function __construct(\DateTime $dateFrom, \DateTime $dateTo)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    /**
     * Create the infinite date range
     *
     * Note: internally, a finite but unusual boundary is used.
     *
     * @return DateRange
     */
    public static function infinite()
    {
        return new static(new \DateTime(self::PAST), new \DateTime(self::FUTURE));
    }
    /**
     * Create a date range with an unbounded past, but a bounded future
     *
     * @param  \DateTime  $end Upper bound
     * @return DateRange
     */
    public static function upTo(\DateTime $end)
    {
        return new static(new \DateTime(self::PAST), $end);
    }
    /**
     * Create a date range with an bounded past, but an unbounded future
     *
     * @param  \DateTime  $start Lower bound
     * @return DateRange
     */
    public static function startingOn(\DateTime $start)
    {
        return new static($start, new \DateTime(self::FUTURE));
    }

    /**
     * @return \DateTime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @return \DateTime
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }
}