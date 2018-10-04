<?php

if (!function_exists('unset_keys')) {
    /**
     * Unset a bunch of keys on given array or object
     *
     * @param array|object $target the target array or object
     * @param array $keys keys to unset
     * @param bool $meets_all
     * *true* the reference array must contains all of those keys. If not, we'll return false
     * *false* (default) unset a key when it appears
     * @return bool success or not
     *
     * @example
     * <code>
     * $target = ['a', 'b', 'c'];
     * unset_keys($target, [1, 3]); // return true, $target = ['a', 'c'];
     *
     * $target = ['a', 'b', 'c'];
     * unset_keys($target, [1, 3], true); // return false, $target = ['a', 'b', 'c'];
     *
     * $target = ['a', 'b', 'c'];
     * unset_keys($target, [1, 2], true); // return true, $target = ['a'];
     * </code>
     *
     * @author ycgambo
     */
    function unset_keys(&$target, array $keys = [], $meets_all = false): bool
    {
        if (empty($keys)) return false;

        if (is_array($target)) {
            $o = false;
        } elseif (is_object($target)) {
            $o = true;
        } else {
            return false;
        }

        if ($meets_all) {
            foreach ($keys as $k) {
                if (!($o ? isset($target->$k) : isset($target[$k]))) return false;
            }
        }

        if ($o) {
            foreach ($keys as $k) {
                unset($target->$k);
            }
        } else {
            foreach ($keys as $k) {
                unset($target[$k]);
            }
        }
        return true;
    }
}

if (!function_exists('ignore_keys')) {
    /**
     * Create an array by ignoring some keys in reference array and keeping the remains
     *
     * @param array|object $array the reference array or object
     * @param array $keys keys to ignore
     * @param bool $meets_all
     * *true* the reference array must contains all of those keys. If not, we'll return the reference array
     * *false* (default) ignore a key when it appears
     * @return array
     *
     * @example
     * <code>
     * ignore_keys(['a', 'b', 'c'], [1, 3]);        // ['a', 'c']
     *
     * ignore_keys(['a', 'b', 'c'], [1, 3], true);  // ['a', 'b', 'c']
     *
     * ignore_keys(['a', 'b', 'c'], [1, 2], true);  // ['a']
     * </code>
     *
     * @author ycgambo
     */
    function ignore_keys($array, array $keys = [], $meets_all = false)
    {
        if (empty($keys)) return $array;

        if (is_array($array)) {
            $o = false;
        } elseif (is_object($array)) {
            $o = true;
        } else {
            return $array;
        }

        if ($meets_all) {
            foreach ($keys as $k) {
                if (!($o ? isset($target->$k) : isset($target[$k]))) return $array;
            }
        }

        $rtn = [];
        if ($o) {
            foreach ($keys as $k) {
                if (isset($array->$k)) continue;
                $rtn[$k] = $array->$k;
            }
        } else {
            foreach ($keys as $k) {
                if (isset($array[$k])) continue;
                $rtn[$k] = $array[$k];
            }
        }
        return $rtn;
    }
}

if (!function_exists('only_keys')) {
    /**
     * Create an array by only taking listed keys in the reference array
     *
     * @param array|object $array the reference array or object
     * @param array $keys keys to take
     * @param bool $meets_all
     * *true* the reference array must contains all of those keys. If not, we'll return an empty array
     * *false* (default) take a key when it appears
     * @return array
     *
     * @example
     * <code>
     * only_keys(['a', 'b', 'c'], [1, 3]);        // ['b']
     *
     * only_keys(['a', 'b', 'c'], [1, 3], true);  // []
     *
     * only_keys(['a', 'b', 'c'], [1, 2], true);  // ['b', 'c']
     * </code>
     *
     * @author ycgambo
     */
    function only_keys($array, array $keys = [], $meets_all = false)
    {
        if (empty($keys)) return [];

        if (is_array($array)) {
            $o = false;
        } elseif (is_object($array)) {
            $o = true;
        } else {
            return [];
        }

        if ($meets_all) {
            foreach ($keys as $k) {
                if (!($o ? isset($target->$k) : isset($target[$k]))) return [];
            }
        }

        $rtn = [];
        if ($o) {
            foreach ($keys as $k) {
                if (isset($array->$k)) $rtn[$k] = $array->$k;
            }
        } else {
            foreach ($keys as $k) {
                if (isset($array[$k])) $rtn[$k] = $array[$k];
            }
        }
        return $rtn;
    }
}

if (!function_exists('std_result')) {
    function std_result(int $code = -1, $msg = 'Failed', $data = null)
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }
}

if (!function_exists('std_success')) {
    function std_success($msg, $data = null, $code = 0)
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }
}

if (!function_exists('std_failure')) {
    function std_failure($msg, $data = null, $code = -1)
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }
}
