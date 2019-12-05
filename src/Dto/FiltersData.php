<?php
namespace App\Dto;

class FiltersData
{
    /**
     * @var string|null
     */
    private $programName;

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
