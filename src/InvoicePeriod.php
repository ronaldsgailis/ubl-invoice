<?php

namespace NumNum\UBL;

use DateTimeInterface;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use InvalidArgumentException;

class InvoicePeriod implements XmlSerializable
{
    private $startDate;
    private $endDate;
    private $descriptionCode;

    public function getStartDate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?DateTimeInterface $startDate): InvoicePeriod
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): ?DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?DateTimeInterface $endDate): InvoicePeriod
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getDescriptionCode(): ?int
    {
        return $this->descriptionCode;
    }

    /**
     * @param Integer $descriptionCode
     * @return InvoicePeriod
     */
    public function setDescriptionCode(?int $descriptionCode): InvoicePeriod
    {
        $this->descriptionCode = $descriptionCode;
        return $this;
    }

    /**
     * The validate function that is called during xml writing to valid the data of the object.
     *
     * @throws InvalidArgumentException An error with information about required data that is missing to write the XML
     * @return void
     */
    public function validate()
    {
        if ($this->descriptionCode === null && ($this->startDate === null && $this->endDate === null)) {
            throw new InvalidArgumentException('Missing startDate or endDate or descriptionCode');
        }
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer): void
    {
        $this->validate();

        if ($this->startDate != null) {
            $writer->write([
                Schema::CBC . 'StartDate' => $this->startDate->format('Y-m-d'),
            ]);
        }
        if ($this->endDate != null) {
            $writer->write([
                Schema::CBC . 'EndDate' => $this->endDate->format('Y-m-d'),
            ]);
        }
        if ($this->descriptionCode !== null) {
            $writer->write([
                Schema::CBC . 'DescriptionCode' => $this->descriptionCode,
            ]);
        }
    }
}
