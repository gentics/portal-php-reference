<#import "template.ftl" as layout>
<@layout.registrationLayout displayInfo=social.displayInfo displayWide=(realm.password && social.providers??); section>


				<form id="kc-form-login" onsubmit="login.disabled = true; return true;" action="${url.loginAction}" method="post">
                    <fieldset>
                        <legend> Login</legend>
                        <section class="form">
                            <div>
                                <label class="holder">E-Mail<span class="mustred">*</span></label>
                                <input type="text" id="user" name="username" class="must" value="${(login.username!'')}" data-error="Bitte eine Email-Adresse angeben">
                            </div>
                            <div>
                                <label class="holder">Passwort<span class="mustred">*</span></label>
                                <input type="password" name="password" id="password" class="must" value="" data-error="Bitte ihr Passwort eingeben">
                            </div>
                            <div class="small">Mit <span class="mustred">*</span> gekennzeichnete Felder sind Pflichtfelder</div>
                            <div>
                                <input type="submit" name="login" class="submit" value="Anmelden" data-error="Username oder Passwort ist falsch">
                            </div>
                        </section>
                    </fieldset>
                </form>
</@layout.registrationLayout>