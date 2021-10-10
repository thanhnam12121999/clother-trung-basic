<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckUniqueMemberPhoneNumber implements Rule
{
    protected $accountRepository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !$this->accountRepository->checkExistsMemberPhoneNumber($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Số điện thoại đã được đăng sử dụng.';
    }
}
