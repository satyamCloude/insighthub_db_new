<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ url('public/assets/') }}" data-template="front-pages">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Two Factor Authentication') }}</div>
                <div class="card-body">
                    <p>{{ __('Please enter the code to complete your login.') }}</p>
                    <form method="POST" action="{{ url('2fa/verify') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="two_factor_recovery_codes"
                                class="col-md-4 col-form-label text-md-right">{{ __('Enter code') }}</label>
                            <div class="col-md-6">
                                <input id="two_factor_recovery_codes" type="text"
                                    class="form-control @error('two_factor_recovery_codes') is-invalid @enderror"
                                    name="two_factor_recovery_codes" required autofocus>

                                @error('two_factor_recovery_codes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Verify') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</html>
