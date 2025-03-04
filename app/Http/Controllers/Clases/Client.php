<?php

namespace App\Http\Controllers\Clases;

class Client
{
    // Original attributes
    public $id;
    public $name;
    public $monthly_income;
    public $monthly_expenses;
    public $requested_amount;
    public $loan_term_months;
    public $credit_score;
    public $current_debt;
    public $current_credits;
    public $current_negative_credits;
    public $value_monthly_payment;
    public $closed_credits;
    public $negative_historical_last_12_months;
    // Attributes added
    public $maximum_percentage;
    public $debt_capacity;
    public $negative_credit_penalization;
    public $negative_dispute_penalization;
    public $debt_to_income_relation;
    public $max_amount;
    public $approved_requested_amount;
    public $credit_status;
    public $negative_dispute_penalization_percentage;

    public function __construct($id, $name, $monthly_income, $monthly_expenses, $requested_amount, $loan_term_months, $credit_score, $current_debt, $current_credits, $current_negative_credits, $value_monthly_payment, $closed_credits, $negative_historical_last_12_months)
    {
        $this->id = $id;
        $this->name = $name;
        $this->monthly_income = $monthly_income;
        $this->monthly_expenses = $monthly_expenses;
        $this->requested_amount = $requested_amount;
        $this->loan_term_months = $loan_term_months;
        $this->credit_score = $credit_score;
        $this->current_debt = $current_debt;
        $this->current_credits = $current_credits;
        $this->current_negative_credits = $current_negative_credits;
        $this->value_monthly_payment = $value_monthly_payment;
        $this->closed_credits = $closed_credits;
        $this->negative_historical_last_12_months = $negative_historical_last_12_months;
        // Added
        $this->maximum_percentage = null;
        $this->debt_capacity = null;
        $this->negative_credit_penalization = null;
        $this->negative_dispute_penalization = null;
        $this->debt_to_income_relation = null;
        $this->max_amount = null;
        $this->approved_requested_amount = null;
        $this->credit_status = null;
        $this->negative_dispute_penalization_percentage = null;
    }


    /**
     * Create user
     * @param Array $clients
     * @return Array $clients
     */
    public static function createClients($json_clients)
    {
        $clients = [];
        foreach ($json_clients as $client) {
            $clients[] = new Client(
                $client->user_id,
                $client->name,
                $client->monthly_income,
                $client->monthly_expenses,
                $client->requested_amount,
                $client->loan_term_months,
                $client->credit_score,
                $client->current_debt,
                $client->current_credits,
                $client->current_negative_credits,
                $client->value_monthly_payment,
                $client->closed_credits,
                $client->negative_historical_last_12_months,
            );
        }
        return $clients;
    }

    /**
     * Calculate maximum percentage
     * @return void
     */
    public function calculateMaximumPercentage(): void
    {
        if ($this->credit_score > 700) {
            $this->maximum_percentage = 0.5;
        } elseif ($this->credit_score >= 400 && $this->credit_score <= 700) {
            $this->maximum_percentage = 0.35;
        } elseif ($this->credit_score < 400) {
            $this->maximum_percentage = 0;
        }
    }

    /**
     * Calculate debt capacity
     * @return void
     */
    public function calculateDebtCapacity(): void
    {
        $this->debt_capacity = intval(($this->monthly_income - $this->monthly_expenses) * $this->maximum_percentage);
    }

    /**
     * Calculate Max Amount
     * @return void
     */
    public function calculateMaxAmount(): void
    {
        $max_amount_parcial = $this->debt_capacity * $this->loan_term_months;

        // negative credit penalization
        $this->negative_credit_penalization = 0;
        if ($this->current_negative_credits > 0) {
            $this->negative_credit_penalization = $max_amount_parcial * 0.3;
            $max_amount_parcial -= $this->negative_credit_penalization;
        }

        // negative dipute penalization
        $this->negative_dispute_penalization = $max_amount_parcial  * ($this->negative_historical_last_12_months * 0.1);
        $max_amount_parcial -= $this->negative_dispute_penalization;

        // debt to income relation penalization
        $this->debt_to_income_relation = ($this->current_debt / $this->monthly_income) * 100;
        if ($this->debt_to_income_relation > 40) {
            $max_amount_parcial -= ($max_amount_parcial * 0.2);
        }
        $this->max_amount = intval($max_amount_parcial);
    }

    /**
     * Calculate Negative Dipute Penalization Percentage
     * @return void
     */
    public function calculateNegativeDisputePenalizationPercentage(): void
    {
        $this->negative_dispute_penalization_percentage = ($this->negative_historical_last_12_months * 0.1) * 100;
    }

    /**
     * Calculate Approved Requested Amount
     * @return void
     */
    public function calculateApprovedRequestedAmount(): void
    {
        if ($this->requested_amount > $this->max_amount) {
            $this->approved_requested_amount = $this->max_amount;
        } elseif ($this->requested_amount <= $this->max_amount) {
            $this->approved_requested_amount = $this->requested_amount;
        }
    }

    /**
     * Get Approved and Rejected Clients
     * @return void
     */
    public function getApprovedAndRejectedClients(): void
    {
        if ($this->credit_score < 400 || $this->negative_historical_last_12_months > 3 || $this->max_amount < 100000) {
            $this->credit_status = 'Rechazado';
        } else {
            $this->credit_status = 'Aprobado';
        }
    }


    /**
     * Process Clients
     *
     * @return void
     **/
    public function processClient(): void
    {
        $this->calculateMaximumPercentage();
        $this->calculateDebtCapacity();
        $this->calculateMaxAmount();
        $this->calculateNegativeDisputePenalizationPercentage();
        $this->calculateApprovedRequestedAmount();
        $this->getApprovedAndRejectedClients();
    }

    /**
     * Get Approved Clients Amount
     *
     * @param int $approved_clients
     * @return int $approved_clients
     **/
    public function getApprovedClientsAmount($approved_clients): int
    {
        if ($this->credit_status == 'Aprobado') {
            $approved_clients++;
        }
        return $approved_clients;
    }

    /**
     * Get Rejected Clients Amount
     *
     * @param int $rejected_clients
     * @return int $rejected_clients
     **/
    public function getRejectedClientsAmount($rejected_clients): int
    {
        if ($this->credit_status == 'Rechazado') {
            $rejected_clients++;
        }
        return $rejected_clients;
    }

    /**
     * Calculate Amount Aproveed Average
     *
     * @param int $accumulateApprovedAmount Description
     * @return int $accumulateApprovedAmount
     **/
    public function accumulateApprovedAmount($accumulateApprovedAmount): int
    {
        return $accumulateApprovedAmount += $this->approved_requested_amount;
    }

    /**
     * Calculate Amount Approved Average
     *
     * @param int $accumulateApprovedAmount int $processed_clients
     * @return int $amount_approved_average
     **/
    public static function calculateAmountApprovedAverage($accumulateApprovedAmount, $processed_clients): int
    {
        $amount_approved_average = round($accumulateApprovedAmount / $processed_clients, 2);
        return  $amount_approved_average;
    }
}
