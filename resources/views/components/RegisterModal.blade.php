<div class="modal fade" id="registerPopup" tabindex="-1" role="dialog" aria-labelledby="registerPopup"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal register-inner-modal">
            <div class="modal-header">
                <div></div>
                <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" class="modal-form register-form" action="{{ route('ajax.register') }}"
                      method="POST">
                    @csrf
                    <h2 class="modal-title">@lang('site.Тіркелу')</h2>
                    <div class="inner-form">
                        <div class="inner-form-left">
                            <div class="form-input-block">
                                <label class="modal-form-label" for="register-phone">Телефон:</label>
                                <input id="register-phone" name="phone" class="modal-form-input phone phone_mask" type="tel" placeholder="+7 (___) ___-__-__" autocomplete="off">
                                <span class="invalid" role="alert" id="error-register-phone"></span>
                            </div>
                            <div class="form-input-block">
                                <label class="modal-form-label" for="full_name">@lang('site.Есіміңіз'):</label>
                                <input id="full_name" name="full_name"
                                       class="modal-form-input" type="text"
                                       placeholder="Есіміңізді енгізіңіз" autocomplete="off">
                                <span class="invalid" role="alert" id="error-register-full_name"></span>
                            </div>
                            <div class="form-input-block">
                                <label class="modal-form-label" for="register-email">@lang('site.Email почтаңыз'):</label>
                                <input id="register-email" name="email"
                                       class="modal-form-input" type="email"
                                       placeholder="Email почтаңызды енгізіңіз" autocomplete="off">
                                <span class="invalid" role="alert" id="error-register-email"></span>
                            </div>
                        </div>

                        <div class="inner-form-right">
                            <div class="form-input-block">
                                <i class="form-input-icon icon-eye" onclick="iconEye(this)"></i>
                                <label class="modal-form-label" for="register-password">@lang('site.Құпиясөз'):</label>
                                <input id="register-password" name="password"
                                       class="modal-form-input password-input" type="password"
                                       placeholder="Құпия сөзді енгізіңіз" autocomplete="off">
                                <i class="form-input-icon icon-eye-off" onclick="iconEyeOff(this)"></i>
                                <span class="invalid" role="alert" id="error-register-password"></span>
                            </div>
                            <div class="form-input-block">
                                <i class="form-input-icon icon-eye" onclick="iconEye(this)"></i>
                                <label class="modal-form-label" for="register-password_confirmation">@lang('site.Құпия сөзді қайта енгізіңіз'):</label>
                                <input id="register-password_confirmation" name="password_confirmation"
                                       class="modal-form-input password-input" type="password"
                                       placeholder="Құпия сөзді қайта енгізіңіз" autocomplete="off">
                                <i class="form-input-icon icon-eye-off" onclick="iconEyeOff(this)"></i>
                                <span class="invalid" role="alert"
                                      id="error-register-password_confirmation"></span>
                            </div>
                        </div>
                    </div>

                    <hr class="modal-hr">

                    <div class="modal-desc-block register-radio">
                        <div class="checkbox">
                            <input class="default-checkbox-input custom-checkbox" type="radio" id="register-teacher"
                                   name="role_id" value="2">
                            <label for="register-teacher">@lang('site.Мұғалім')</label>
                        </div>
                        <div class="checkbox">
                            <input class="default-checkbox-input custom-checkbox" type="radio" id="register-pupil"
                                   name="role_id" value="3">
                            <label for="register-pupil">@lang('site.Оқушы')</label>
                        </div>
                        <div class="checkbox">
                            <input class="default-checkbox-input custom-checkbox" type="radio"
                                   id="register-educator"
                                   name="role_id" value="4">
                            <label for="register-educator">@lang('site.Тәрбиеші')</label>
                        </div>
                        <div class="checkbox">
                            <input class="default-checkbox-input custom-checkbox" type="radio" id="register-student"
                                   name="role_id" value="5">
                            <label for="register-student">Студент</label>
                        </div>

                        <div class="checkbox-error">
                            <span class="invalid" role="alert" id="error-register-role_id"></span>
                        </div>
                    </div>

                    <button type="submit" class="modal-default-btn">@lang('site.Тіркелу')</button>
                </form>
            </div>

            <div class="modal-footer register-modal-footer">
                <p class="modal-description">@lang('site.«Тіркелу» батырмасын басу арқылы сіз пайдаланушы келісімінде көрсетілген шарттармен келісесіз')</p>
            </div>
        </div>
    </div>
</div>
