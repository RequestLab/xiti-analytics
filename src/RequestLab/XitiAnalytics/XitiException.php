<?php

/*
 * This file is part of the RequestLab package.
 *
 * (c) RequestLab <hello@requestlab.fr>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace RequestLab\XitiAnalytics;

/**
 * Xiti analytics Exception.
 *
 * @author ylcdx <yann@requestlab.fr>
 */
class XitiException extends \Exception
{
    /**
     * @param $error
     * @return XitiException
     */
    public static function invalidQuery($error)
    {
        return new self(sprintf('An error occured when querying the AT Internet service v2 (%s).', $error));
    }

    /**
     * @param $error
     * @return XitiException
     */
    public static function invalidParameter($error)
    {
        return new self(sprintf('An error occured when querying the AT Internet service v2 (%s is required).', $error));
    }

}