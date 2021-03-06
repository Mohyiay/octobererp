<?php namespace Olabs\Oims\Models;

use Model;

/**
 * Model
 */
class PaymentReceivable extends BaseModel
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    const CNAME = 'payment_receivables';
    
    
    public function getEntityType()
    {
        return self::CNAME;
    }
    
    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'olabs_oims_payment_receivables';
    
    public $belongsTo = [
        'objectstatus' => [
            'Olabs\Oims\Models\Status', 
            'key' => 'status'
        ],           
        'project' => [
            'Olabs\Oims\Models\Project', 
            'key' => 'project_id'
        ], 
               
    ];
    
    protected $jsonable = [
        'paid_detail'
        ];
    
    public $attachMany = [
        'featured_images' => ['System\Models\File', 'order' => 'sort_order'],
        'content_images' => ['System\Models\File']
    ];
    
    public function filterFields($fields, $context = null){
        if($fields->payment_method){
//            dd($fields->{'paid_detail[payment_from]'});
            $fields->{'paid_detail[payment_from]'}->hidden = true;
            $fields->{'paid_detail[payment_to]'}->hidden = true;
            $fields->{'paid_detail[transaction_id]'}->hidden = true;
            
            $fields->{'paid_detail[cheque_number]'}->hidden = true;
            $fields->{'paid_detail[cheque_date]'}->hidden = true;
            $fields->{'paid_detail[cheque_account]'}->hidden = true;
            
            $fields->{'paid_detail[dd_number]'}->hidden = true;
            $fields->{'paid_detail[issuing_bank]'}->hidden = true;
            $fields->{'paid_detail[issue_date]'}->hidden = true;
            
            if($fields->payment_method->value == PaymentReceivable::PAYMENT_METHOD_CHEQUE){
                $fields->{'paid_detail[cheque_number]'}->hidden = false;
                $fields->{'paid_detail[cheque_date]'}->hidden = false;
                $fields->{'paid_detail[cheque_account]'}->hidden = false;
            }else if($fields->payment_method->value == PaymentReceivable::PAYMENT_METHOD_BANK_TRANSFER){
                $fields->{'paid_detail[payment_from]'}->hidden = false;
                $fields->{'paid_detail[payment_to]'}->hidden = false;
                $fields->{'paid_detail[transaction_id]'}->hidden = false;
            }else if($fields->payment_method->value == PaymentReceivable::PAYMENT_METHOD_DEMAND_DRAFT){
                $fields->{'paid_detail[dd_number]'}->hidden = false;
                $fields->{'paid_detail[issuing_bank]'}->hidden = false;
                $fields->{'paid_detail[issue_date]'}->hidden = false;
            }
                
        }
        
    }
}