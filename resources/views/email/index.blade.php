<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Email</title>
    <style>
        .button{
            border: 1px solid;
            font-family: "Poppins";
            font-weight: 700;
            border-radius: 7px;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #435ebe;
            color: white;
        }
    </style>
</head>

<body>
    <table>
        <tbody>
            <tr>
                <td>
                    Hello {{ $user->name }}
                </td>
            </tr>
            <tr>
                <td>
                    Click this button to verify your email.
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{ route('email.verify', ['token' => $user->remember_token, 'signature' => $encrypt]) }}"
                        >
                        <button class="button">Verify Email</button>
                    
                    </a>
                </td>
            </tr>
            <tr>
                <td>Or</td>
            </tr>
            <tr>
                <td>
                    <a href="{{ route('email.verify', ['token' => $user->remember_token, 'signature' => $encrypt]) }}"
                        >
                        {{ route('email.verify', ['token' => $user->remember_token, 'signature' => $encrypt]) }}
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
