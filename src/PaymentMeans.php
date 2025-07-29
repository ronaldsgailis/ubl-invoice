<?php

namespace NumNum\UBL;

use DateTimeInterface;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class PaymentMeans implements XmlSerializable
{
    public $xmlTagName = 'PaymentMeans';
    private $paymentMeansCode = UNCL4461::INSTRUMENT_NOT_DEFINED;
    private $paymentMeansCodeAttributes = [
        'listID' => 'UN/ECE 4461',
        'listName' => 'Payment Means',
        'listURI' => 'http://docs.oasis-open.org/ubl/os-UBL-2.0-update/cl/gc/default/PaymentMeansCode-2.0.gc'];
    private $paymentDueDate;
    private $instructionId;
    private $instructionNote;
    private $paymentId;
    private $payeeFinancialAccount;

    /**
     * @return string
     */
    public function getPaymentMeansCode(): ?string
    {
        return $this->paymentMeansCode;
    }

    /**
     * @param string $paymentMeansCode
     * @return PaymentMeans
     */
    public function setPaymentMeansCode(?string $paymentMeansCode, $attributes = null): PaymentMeans
    {
        $this->paymentMeansCode = $paymentMeansCode;
        if (isset($attributes)) {
            $this->paymentMeansCodeAttributes = $attributes;
        }
        return $this;
    }

    public function getPaymentDueDate(): ?DateTimeInterface
    {
        return $this->paymentDueDate;
    }

    public function setPaymentDueDate(?DateTimeInterface $paymentDueDate): PaymentMeans
    {
        $this->paymentDueDate = $paymentDueDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstructionId(): ?string
    {
        return $this->instructionId;
    }

    /**
     * @param string $instructionId
     * @return PaymentMeans
     */
    public function setInstructionId(?string $instructionId): PaymentMeans
    {
        $this->instructionId = $instructionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstructionNote(): ?string
    {
        return $this->instructionNote;
    }

    /**
     * @param string $instructionNote
     * @return PaymentMeans
     */
    public function setInstructionNote(?string $instructionNote): PaymentMeans
    {
        $this->instructionNote = $instructionNote;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    /**
     * @param string $paymentId
     * @return PaymentMeans
     */
    public function setPaymentId(?string $paymentId): PaymentMeans
    {
        $this->paymentId = $paymentId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayeeFinancialAccount(): ?PayeeFinancialAccount
    {
        return $this->payeeFinancialAccount;
    }

    /**
     * @param mixed $payeeFinancialAccount
     * @return PaymentMeans
     */
    public function setPayeeFinancialAccount(?PayeeFinancialAccount $payeeFinancialAccount): PaymentMeans
    {
        $this->payeeFinancialAccount = $payeeFinancialAccount;
        return $this;
    }

    public function xmlSerialize(Writer $writer): void
    {
        $writer->write([
            'name' => Schema::CBC . 'PaymentMeansCode',
            'value' => $this->paymentMeansCode,
            'attributes' => $this->paymentMeansCodeAttributes
        ]);

        if ($this->getPaymentDueDate() !== null) {
            $writer->write([
                Schema::CBC . 'PaymentDueDate' => $this->getPaymentDueDate()->format('Y-m-d')
            ]);
        }

        if ($this->getInstructionId() !== null) {
            $writer->write([
                Schema::CBC . 'InstructionID' => $this->getInstructionId()
            ]);
        }

        if ($this->getInstructionNote() !== null) {
            $writer->write([
                Schema::CBC . 'InstructionNote' => $this->getInstructionNote()
            ]);
        }

        if ($this->getPaymentId() !== null) {
            $writer->write([
                Schema::CBC . 'PaymentID' => $this->getPaymentId()
            ]);
        }

        if ($this->getPayeeFinancialAccount() !== null) {
            $writer->write([
                Schema::CAC . 'PayeeFinancialAccount' => $this->getPayeeFinancialAccount()
            ]);
        }
    }
}
