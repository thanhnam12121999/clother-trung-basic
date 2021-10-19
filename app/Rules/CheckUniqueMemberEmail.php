<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckUniqueMemberEmail implements Rule
{
    protected $accountRepository;
    protected $isSignup;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($accountRepository, $isSignup = false)
    {
        $this->accountRepository = $accountRepository;
        $this->isSignup = $isSignup;
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
        $member = $this->accountRepository->getAccountMemberByEmail($value);
        if (empty($member)) {
            return true;
        } else {
            if (!$this->isSignup && $member->id == getLoggedInUser()->id) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email đã được sử dụng.';
    }
}
