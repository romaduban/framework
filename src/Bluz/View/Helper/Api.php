<?php
/**
 * Copyright (c) 2013 by Bluz PHP Team
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * @namespace
 */
namespace Bluz\View\Helper;

use Bluz\View\View;

return
    /**
     * API call from View
     * Be carefully, use it for calculate/update/save some data
     * For render information use Widgets!
     *
     * <pre>
     * <code>
     * $this->api($module, $method, array $params);
     * </code>
     * </pre>
     *
     * @param string $module
     * @param string $method
     * @param array $params
     * @return View
     */
    function ($module, $method, $params = array()) {
    /** @var View $this */
    $application = app();
    try {
        $apiClosure = $application->api($module, $method);
        return call_user_func_array($apiClosure, $params);
    } catch (\Exception $e) {
        if (app()->isDebug()) {
            // exception message for developers
            echo
                '<div class="alert alert-error">' .
                '<strong>API "' . $module . '/' . $method . '"</strong>: ' .
                $e->getMessage() .
                '</div>';
        }
    }
    };
