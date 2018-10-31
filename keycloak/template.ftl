<#macro registrationLayout bodyClass="" displayInfo=false displayMessage=true displayWide=false>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>🚀 Gentics Portal|Java - Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://localhost:8000/static/reference/files/css/styles.css" media="all" />
</head>

<body>
<section>
    <h1>Login</h1>
    <#if displayMessage && message?has_content>
        <div class="alert alert-${message.type}">
            <#if message.type = 'success'><span class="${properties.kcFeedbackSuccessIcon!}"></span></#if>
            <#if message.type = 'warning'><span class="${properties.kcFeedbackWarningIcon!}"></span></#if>
            <#if message.type = 'error'><span class="${properties.kcFeedbackErrorIcon!}"></span></#if>
            <#if message.type = 'info'><span class="${properties.kcFeedbackInfoIcon!}"></span></#if>
            <span class="kc-feedback-text">${message.summary?no_esc}</span>
        </div>
    </#if>
    <#nested "form">
</section>
</body>
</html>
</#macro>