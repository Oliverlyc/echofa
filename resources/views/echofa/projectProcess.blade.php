@inject('request','Illuminate\Http\Request')
@extends('layouts.echofa')
@section('ganttBtn')
    <a href="{{ route('showProjectProcessChart') }}" type="button " @if(!$request->query('type')||$request->query('type') == 'processing') class="btn btn-default btn-lg btn-active" @else class="btn btn-default btn-lg btn-standby active" @endif style="width: 200px;margin: 8px 60px 0 150px">{{__('进行中')}}</a>
    <a href="{{ route('showProjectProcessChart').'?type=finish' }}" type="button" @if($request->query('type') == 'finish') class="btn btn-default btn-lg btn-active " @else class="btn btn-default btn-lg btn-standby active" @endif style="width: 200px;margin-top: 8px;">{{__('已完成')}}</a>
@endsection
@section('content')
    <div class="container-fluid" style="padding: 0 0 0 0;">
        <div class="gantt"></div>
    </div>
    <script>
        $(function () {
            var dataSource = {!! $projectList !!};
//             shifts dates closer to Date.now()
//            var offset = new Date().setHours(0, 0, 0, 0) -
//                new Date(demoSource[0].values[0].from).setDate(35);
//            for (var i = 0, len = demoSource.length, value; i < len; i++) {
//                value = demoSource[i].values[0];
//                value.from += offset;
//                value.to += offset;
//            }

            $(".gantt").gantt({
                source: dataSource,
                navigate: "scroll",
                scale: "days",
                maxScale: "months",
                minScale: "weeks",
                months: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                dow: ['日', '一', '二', '三', '四', '五', '六'],
                itemsPerPage: 31,
                scrollToToday: true,
                useCookie: false,
                waitText: "正在加载图表......",
//                onItemClick: function (data) {
//                    alert("Item clicked - show some details");
//                },
//                onAddClick: function (dt, rowId) {
//                    alert("Empty space clicked - add an item!");
//                },
                onRender: function () {
                    if (window.console && typeof console.log === "function") {
                        console.log("chart rendered");
                    }
                }
            });

            $(".gantt").popover({
                selector: ".bar",
                title: function _getItemText() {
                    return this.textContent;
                },
                content: "",
                trigger: "hover",
                placement: "auto"
            });

            prettyPrint();

        });
    </script>
@endsection
