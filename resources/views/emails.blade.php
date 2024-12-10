<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width">
    <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">
    <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>@yield('head-title')</title>
    <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
    <style>
        * {
            font-family: sans-serif !important;
        }
    </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg:  -->
    <link href='https://fonts.googleapis.com/css2?family=Bungee&family=Source+Sans+Pro:wght@400;700&display=swap' rel='stylesheet' type='text/css'>
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */

        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */

        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            color: #192650;
            line-height: 1.625;
        }

        /* USER CUSTOM STYLES FOR EMAILS */
        h1, h2, h3, h4, h5, h6, button {
            font-family: 'Bungee', 'Arial Black', 'Arial';
            font-weight: bold;
        }

        p, ul, li {
            font-family: 'Source Sans Pro','Verdana', 'ui-serif';
        }

        .btn {
            padding: 4px 16px;
            box-shadow: 0px 0px, 1px 1px, 2px 2px, 3px 3px, 4px 4px, 5px 5px,
            6px 6px;
            margin-bottom: 6px;
            color: #3A5DA8;
            display: inline-block;
            text-align: center;
            text-transform: uppercase;
            background: #ffffff;
            border-color: currentColor;
            border-style: solid;
            font-family: 'Bungee', 'Arial Black', 'Arial';
        }

        h1 {
            font-size: 24px;
            margin-bottom: 16px;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        a {
            color: #192650 !important;
        }

        ul {
            list-style: none;
        }

        li {
            color: #F8F8F8;
            margin-bottom: 4px;
        }

        ul li::before {
            content: "\2022";  /* Add content: \2022 is the CSS Code/unicode for a bullet */
            color: #3A5DA8; /* Change the color */
            font-weight: bold; /* If you want it to be bold */
            display: inline-block; /* Needed to add space between the bullet and the text */
            width: 1.25em; /* Also needed for space (tweak if needed) */
            margin-left: -1.25em; /* Also needed for space (tweak if needed) */
        }

        p {
            font-size: 16px;
            color: #192650;
            margin-top: 0px;
            margin-bottom: 8px;
        }

        section {
            margin-bottom: 32px;
        }

        section:last-of-type {
            margin-bottom: 0px;
        }



        /* END USER CUSTOM STYLES FOR EMAILS */

        /* What it does: Stops email clients resizing small text. */

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */

        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */

        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */

        *[x-apple-data-detectors],
        /* iOS */

        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */

        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */

        img.g-img+div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */

        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */

        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            .email-container {
                min-width: 320px !important;
            }
        }

        /* iPhone 6, 6S, 7, 8, and X */

        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            .email-container {
                min-width: 375px !important;
            }
        }

        /* iPhone 6+, 7+, and 8+ */

        @media only screen and (min-device-width: 414px) {
            .email-container {
                min-width: 414px !important;
            }
        }
    </style>
    <!-- CSS Reset : END -->
    <!-- Reset list spacing because Outlook ignores much of our inline CSS. -->
    <!--[if mso]>
    <style type="text/css">
        ul,
        ol {
            margin: 0 !important;
        }

        li {
            margin-left: 30px !important;
        }

        li.list-item-first {
            margin-top: 0 !important;
        }

        li.list-item-last {
            margin-bottom: 10px !important;
        }
    </style>
    <![endif]-->

    <!-- Progressive Enhancements : BEGIN -->
    <style>
        /* What it does: Hover styles for buttons */

        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }

        .button-td-primary:hover,
        .button-a-primary:hover {
            background: #F8F8F8 !important;
            border-color: #F8F8F8 !important;
        }

        /* Media Queries */

        @media screen and (max-width: 600px) {

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
            }

        }
    </style>
    <!-- Progressive Enhancements : END -->

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

</head>
<!--
	The email background color (#222222) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #F8F8F8;">
    <center style="width: 100%; background-color: #F8F8F8;">
        <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
           style="background-color: #F8F8F8;">
        <tr>
            <td>
    <![endif]-->

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">

        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
        <!-- Preview Text Spacing Hack : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Preview Text Spacing Hack : END -->

        <!--
    Set the email width. Defined in two places:
    1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
    2. MSO tags for Desktop Windows Outlook enforce a 600px width.
-->
        <div style="max-width: 500px; margin: 0 auto;" class="email-container">
            <!--[if mso]>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600">
            <tr>
                <td>
        <![endif]-->

            <!-- Email Body : BEGIN -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 auto; border: 4px solid #3A5DA8; color: #3A5DA8; border-color: currentColor; background: #ffffff;">
                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                    <td>
                        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td border="0" cellpadding="0" cellspacing="0">
                                    <img src="@yield('image-url')" width="600" alt="" border="0"
                                        style="display: block; width: 100%; max-width: 600px; height: auto; background: #dddddd;"
                                        class="g-img">
                                </td>
                            </tr>
                            <!-- Hero Image, Flush : END -->

                            <!-- 1 Column Text + Button : BEGIN -->
                            <tr>
                                <td style="background-color: #ffffff; ">
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #ffffff;">

                                        <tr>
                                            <td style="padding: 24px; font-family: sans-serif; font-size: 16px; line-height: 22px;">
                                               @hasSection('email-heading')
                                                    <h1 style="margin-bottom: 32px; font-size: 24px;">@yield('email-heading')</h1>
                                                @endif

                                                @hasSection('email-greeting')
                                                    <p style="margin-bottom: 24px; font-weight: bold; font-size: 18px;">@yield('email-greeting')</p>
                                                @endif
                                                
                                                @yield('content')

                                                <p style="margin-top:32px; margin-bottom: 0px; color: #3A5DA8; font-weight: bold;">From, <br> <span style="margin-left: 24px;">Omaash</span></p>

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- 1 Column Text + Button : END -->
                        </table>
                    </td>
                </tr> 

                <!-- FOOTER LOGO -->
                <tr>
                    <td style="padding: 24px 0 0 0;  margin: 0; line-height: 0;" align="center" cellpadding="0" cellspacing="0" border="0">
                        <h3 style=" line-height: 1; text-align: center; font-size: 14px; margin-bottom: 16px; color: #8D8D8D;">
                            Omaash Nation!
                        </h3>
                        <a href={{ env('APP_URL') }} target="_blank">
                            <img src={{ url("/images/emails/omaash-avatar-full.png") }} width="250" height="" alt=""
                            border="0" style="width: 100%; max-width: 96px; height: display: block; auto; margin: auto;">
                        </a>
                    </td>
                </tr>
            </table>
            <!-- Email Body : END -->

            <!--[if mso]>
        </td>
        </tr>
        </table>
        <![endif]-->
        </div>

        <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
    </center>
</body>

</html>
