<?php
namespace StandardLibary\Helpers;

class DateHelper
{
    /**
     * 用字符串获取时间
     *
     * @param string $dateString
     * @return string
     */
    public static function getDateByString(string $dateString): string
    {
        return date('Y-m-d', strtotime($dateString));
    }

    public static function getYesterdayStart()
    {
        return date('Y-m-d 00:00:00', strtotime('-1 days'));
    }

    public static function getYesterdayEnd()
    {
        return date('Y-m-d 23:59:59', strtotime('-1 days'));
    }

    public static function getDayStart(): string
    {
        return date("Y-m-d 00:00:00");
    }

    public static function getDayEnd(): string
    {
        return date("Y-m-d 23:59:59");
    }

    public static function getWeekStart(): string
    {
        return self::getDateByString('monday this week') . ' 00:00:00';
    }

    public static function getWeekEnd(): string
    {
        return self::getDateByString('sunday this week') . ' 23:59:59';
    }

    public static function getLastWeekStart(): string
    {
        return self::getDateByString('monday last week') . ' 00:00:00';
    }

    public static function getLastWeekEnd(): string
    {
        return self::getDateByString('sunday last week') . ' 23:59:59';
    }

    public static function getMonthStart(): string
    {
        return date("Y-m-01") . ' 00:00:00';
    }

    public static function getMonthEnd(): string
    {
        return date("Y-m-t") . ' 23:59:59';
    }

    public static function getLastMonthStart(): string
    {
        return date("Y-m-01", strtotime('-1 months')) . ' 00:00:00';
    }

    public static function getLastMonthEnd(): string
    {
        return date("Y-m-t", strtotime('-1 months')) . ' 23:59:59';
    }

    public static function getYearStart(): string
    {
        return date("Y-01-01") . ' 00:00:00';
    }

    public static function getYearEnd(): string
    {
        return date("Y-12-31") . ' 23:59:59';

    }

}
