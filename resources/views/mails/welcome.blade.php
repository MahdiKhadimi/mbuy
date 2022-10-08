Hellow! welcome {{ $user->name }}, Thank you to creating an account.
To verify your account please use the flow link.
{{ route('user.verify',$user->verification_token) }}
