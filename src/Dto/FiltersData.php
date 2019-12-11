<?php

namespace App\Dto;

class FiltersData
{
    /**
     * @var string|null
     */
    private $academyName;

    /**
     * @var string|null
     */
    private $programName;

    /**
     * @var string|null
     */
    private $programPrice;

    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $pageSize = 10;

    /**
     * @return string|null
     */
    public function getProgramName(): ?string
    {
        return $this->programName;
    }

    /**
     * @param string|null $programName
     */
    public function setProgramName(?string $programName): void
    {
        $this->programName = $programName;
    }

    /**
     * @return string|null
     */
    public function getAcademyName(): ?string
    {
        return $this->academyName;
    }

    /**
     * @param string|null $academyName
     */
    public function setAcademyName(?string $academyName): void
    {
        $this->academyName = $academyName;
    }

    /**
     * @return string|null
     */
    public function getProgramPrice(): ?string
    {
        return $this->programPrice;
    }

    /**
     * @param string|null $programPrice
     */
    public function setProgramPrice(?string $programPrice): void
    {
        $this->programPrice = $programPrice;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }
}
