<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eagle Jump</title>
</head>
<body onload="window.print()">
    <div class="header">
        <span class="y-title">{{ $letter->mail_subject }}</span>
    </div>
    <div class="content"> <br>
        <span style="float: right;">{{ $letter->incoming_at->format('d, M Y') }}</span> <br><br>
        {!! $letter->mail_content !!}
    </div>
</body>
</html>