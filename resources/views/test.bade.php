<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<button class="btn btn-sm btn-danger" id="btn-apply-refund">申请退款</button>
<script>
    $(document).ready(function () {

        $('#btn-apply-refund').click(function () {

            swal({
                icon: "warning",
                title: '确认已经收到商品？',
                dangerMode: true,
                buttons: ['cancel', 'ok']
            })
                .then(function (ret) {
                    if (!ret) {
                        return;
                    }

                    axios.post("{{ route('orders.received', [$order->id]) }}").then(function () {
                        location.reload();
                    })
                })

        })

    })
</script>
</body>
</html>
