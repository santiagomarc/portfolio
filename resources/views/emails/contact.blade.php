<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #2c3e50; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #3498db; color: white; padding: 20px; text-align: center; border-radius: 5px 5px 0 0; }
        .body { background: #f8f9fa; padding: 25px; border: 1px solid #ecf0f1; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #7f8c8d; font-size: 12px; text-transform: uppercase; }
        .value { margin-top: 4px; font-size: 15px; }
        .message-box { background: white; padding: 15px; border-left: 4px solid #3498db; border-radius: 3px; margin-top: 5px; }
        .footer { text-align: center; padding: 15px; font-size: 12px; color: #95a5a6; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin: 0;">New Portfolio Contact Message</h2>
        </div>
        <div class="body">
            <div class="field">
                <div class="label">From</div>
                <div class="value">{{ $senderName }}</div>
            </div>
            <div class="field">
                <div class="label">Email</div>
                <div class="value"><a href="mailto:{{ $senderEmail }}">{{ $senderEmail }}</a></div>
            </div>
            <div class="field">
                <div class="label">Message</div>
                <div class="message-box">{{ $body }}</div>
            </div>
        </div>
        <div class="footer">
            Sent from your Portfolio CMS &middot; {{ now()->format('F j, Y g:i A') }}
        </div>
    </div>
</body>
</html>
