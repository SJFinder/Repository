<?php

namespace SJFinder\Repository\Contracts;

interface RepositoryCriteriaInterface
{
    /**
     * Push Criteria for filter the query.
     *
     * @param CriteriaInterface $criteria
     *
     * @return mixed
     */
    public function pushCriteria(CriteriaInterface $criteria);

    /**
     * Get Collection of Criteria.
     *
     * @return mixed
     */
    public function getCriteria();

    /**
     * Find data by Criteria.
     *
     * @param CriteriaInterface $criteria
     *
     * @return mixed
     */
    public function getByCriteria(CriteriaInterface $criteria);

    /**
     * Skip Criteria.
     *
     * @param bool $status
     *
     * @return mixed
     */
    public function skipCriteria($status = true);

    /**
     * Apply criteria in current query.
     *
     * @return $this
     */
    public function applyCriteria();
}
