<div class="modal fade" id="registerPopup" tabindex="-1" role="dialog" aria-labelledby="registerPopup"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content inner-modal">
            <div class="modal-header">
                <h2 class="modal-title">Тіркелу</h2>
                <button type="button" class="close modal-close" data-dismiss="modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="only-register">
                    <form id="registerForm" class="modal-form" action="">
                        @csrf
                        <div class="form-input-block">
                            <label class="modal-form-label" for="register-phone">Телефон:</label>
                            <input id="register-phone" name="phone"
                                   class="modal-form-input phone" type="tel"
                                   placeholder="+7 (7__) ___-__-__" required>
                            <span class="invalid-feedback" role="alert" id="error-register-phone"></span>
                        </div>

                        <div class="form-input-block">
                            <label class="modal-form-label" for="full_name">Есіміңіз:</label>
                            <input id="full_name" name="full_name"
                                   class="modal-form-input" type="text"
                                   placeholder="Есіміңізді енгізіңіз" required>
                            <span class="invalid-feedback" role="alert" id="error-register-full_name"></span>
                        </div>

                        <div class="form-input-block">
                            <label class="modal-form-label" for="register-email">Email Почтаңыз:</label>
                            <input id="register-email" name="email"
                                   class="modal-form-input" type="email"
                                   placeholder="Email почтаңызды енгізіңіз" required>
                            <span class="invalid-feedback" role="alert" id="error-register-email"></span>
                        </div>

                        <div class="form-input-block">
                            <i class="form-input-icon icon-eye" onclick="iconEye(this)"></i>
                            <label class="modal-form-label" for="register-password">Құпиясөз:</label>
                            <input id="register-password" name="password"
                                   class="modal-form-input password-input" type="password"
                                   placeholder="Құпия сөзді енгізіңіз" required>
                            <i class="form-input-icon icon-eye-off" onclick="iconEyeOff(this)"></i>
                            <span class="invalid-feedback" role="alert" id="error-register-password"></span>
                        </div>

                        <div class="form-input-block">
                            <i class="form-input-icon icon-eye" onclick="iconEye(this)"></i>
                            <label class="modal-form-label" for="register-password_confirmation">Құпия сөзді қайта
                                енгізіңіз:</label>
                            <input id="register-password_confirmation" name="password_confirmation"
                                   class="modal-form-input password-input" type="password"
                                   placeholder="Құпия сөзді қайта енгізіңіз" required>
                            <i class="form-input-icon icon-eye-off" onclick="iconEyeOff(this)"></i>
                            <span class="invalid-feedback" role="alert"
                                  id="error-register-password_confirmation"></span>
                        </div>

                        <hr class="modal-hr">

                        <div class="modal-desc-block register-checkbox">
                            <div class="checkbox">
                                <input class="default-checkbox-input" type="checkbox" id="register-confirm_site_rules"
                                       name="role_id" value="">
                                <label for="register-confirm_site_rules">
                                    Нажимая на кнопку «Зарегистрироваться», я соглашаюсь с Правилами сайта и
                                    Пользовательской рассылкой
                                </label>
                            </div>
                        </div>
                        <span class="invalid-feedback mb-3" role="alert" id="error-register-role_id"></span>

                        <button type="submit" class="modal-default-btn">Тіркелу</button>

                        {{--                        <div class="modal-desc-block register-checkbox">--}}
                        {{--                            <div class="checkbox">--}}
                        {{--                                <input class="default-checkbox-input" type="checkbox" id="register-confirm_site_rules"--}}
                        {{--                                       name="confirm_site_rules">--}}
                        {{--                                <label for="register-confirm_site_rules">--}}
                        {{--                                    Нажимая на кнопку «Зарегистрироваться», я соглашаюсь с Правилами сайта и--}}
                        {{--                                    Пользовательской рассылкой--}}
                        {{--                                </label>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <span class="invalid-feedback mb-3" role="alert" id="error-register-confirm_site_rules"></span>--}}
                        {{--                        <div class="modal-desc-block register-checkbox">--}}
                        {{--                            <div class="checkbox">--}}
                        {{--                                <input class="default-checkbox-input" type="checkbox"--}}
                        {{--                                       id="register-confirm_privacy_policy"--}}
                        {{--                                       name="confirm_privacy_policy">--}}
                        {{--                                <label for="register-confirm_privacy_policy">--}}
                        {{--                                    Нажимая на кнопку «Зарегистрироваться»,я соглашаюсь c Пользовательским соглашением и--}}
                        {{--                                    Политикой конфиденциальности--}}
                        {{--                                </label>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <span class="invalid-feedback" role="alert" id="error-register-confirm_privacy_policy"></span>--}}
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
