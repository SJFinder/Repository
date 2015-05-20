<?php namespace SJFinder\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * Search from manually input.
     *
     * @param Builder $query
     * @param string $field
     * @param string|array $value
     * @param string $boolean
     * @return Builder
     */
    public function scopeOfValue($query, $field, $value, $boolean = 'and')
    {
        return $this->_where($query, $field, $value, $boolean);
    }

    /**
     * Search from request input
     *
     * @param Builder $query
     * @param string $field
     * @param string|array $value
     * @param string $boolean
     * @return Builder
     */
    public function scopeOfInput($query, $field, $value, $boolean = 'and')
    {
        if (is_array($value) and ! isset($value[$field])) {
            return $query;
        }

        return $this->_where($query, $field, $value[$field], $boolean);
    }

    /**
     * Generate where query builder
     *
     * @param Builder $query
     * @param string $field
     * @param string|array $value
     * @param string $boolean
     * @return Builder
     */
    private function _where($query, $field, $value, $boolean = 'and')
    {
        if (empty($field) or $value === null) {
            return $query;
        }

        if ($boolean === 'and') {
            $oper = is_array($value) ? 'whereIn' : 'where';
        } else {
            $oper = is_array($value) ? 'orWhereIn' : 'orWhere';
        }

        return $query->{$oper}($field, $value);
    }

    /**
     * Find where statement.
     *
     * @param Builder $query
     * @param string $field
     * @param string $keyword
     * @param string $boolean
     * @return Builder
     */
    public function scopeOfFind($query, $field, $keyword, $boolean = "or")
    {
        if (empty($field) or $keyword === null or count($keyword) === 0) {
            return $query;
        }
        $oper = ($boolean === 'or') ? 'orWhere' : 'where';

        return $query->{$oper}($field, 'like', "%$keyword%");
    }

    /**
     * Scope of where not statement.
     *
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @return Builder
     */
    public function scopeOfNot($query, $field, $value)
    {
        if (empty($field) or $value === null) {
            return $query;
        }

        return $query->where($field, '!=', $value);
    }

}