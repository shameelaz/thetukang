<DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('overide/web/themes/apim/default/images/lhdn.png') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="LHDN API Management Portal to enabled integration information to be executed systematically, accurately, quickly and securely">
        <meta name="keywords" content="apim, apim portal, lhdn apim, lhdn apim portal, portal apim, api portal">
        <meta name="author" content="LEFT4CODE">
        <title>{{config('app.name')}}</title>
        <!-- BEGIN: CSS Assets-->


        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">




        <link rel="stylesheet" href="{{asset('overide/web/themes/apim/assets/css/app.css')}}" />
        <link rel="stylesheet" href="{{asset('overide/web/themes/apim/assets/fonts/fn.css')}}" />

        <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/themes/horizontal-menu-template/materialize.css')}}" />

        <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/vendors/animate-css/animate.css')}}">

<!-- 
        <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/vendors/vendors.min.css')}}"> -->

  
           <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/data-tables/css/jquery.dataTables.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/data-tables/extensions/responsive/css/responsive.dataTables.css')}}">    

           <!--  <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/pages/page-account-settings.css')}}"> -->

            <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/pages/page-knowledge.css')}}">

            

          <!--   <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/pages/dashboard.css')}}"> -->

            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/css/pages/app-sidebar.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/css/pages/app-contacts.css')}}">

            <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/pages/intro.css')}}">
         <!--    <link rel="stylesheet" href="{{asset('overide/web/themes/apim/default/css/custom/custom.css')}}"> -->

            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/css/pages/form-select2.css')}}">

            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/sweetalert/sweetalert.css')}}">

       
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/data-tables/css/select.dataTables.min.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/css/pages/data-tables.css')}}">

            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/select2/select2.min.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/select2/select2-materialize.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/css/pages/form-select2.css')}}">

            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.css">


            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/redactor/redactor.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/redactor/plugins/clips/clips.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/vendors/redactor/plugins/alignment/alignment.css')}}">
<!-- 
            <link rel="stylesheet" type="text/css" href="{{asset('overide/web/themes/apim/default/css/pages/widget-timeline.css')}}">  -->


        <!--------->
       
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->

     @stack('style')

    <style type="text/css">
        .swal-title {
 color:rgba(0,0,0,.65);
 font-weight:600;
 text-transform:none;
 position:relative;
 display:block;
 padding:13px 16px;
 font-size:18px;
 line-height:normal;
 text-align:center;
 margin-bottom:0
},
.btnadd {
    background-color: #50ca67;
},
.tdbreak {
  word-break: break-all
}
.wrap-me{
  word-break: break-all !important;
}

    </style>
    <!-- fezrul card class inline -->
    <style type="text/css">
        .gradient-45deg-indigo-purple
        {
            background-color: #5F0F4E !important;color:white;
            
        }

        .gradient-45deg-deep-purple-blue
        {
            /*background-image: linear-gradient(45deg, #6200ea, #1976d2) !important;
            color:white;*/

            background-color: #E52A6F !important;color:white;
        }

        .gradient-45deg-amber-amber
        {
           /* background-image: linear-gradient(45deg, #ff6f00, #ffca28) !important;
            color:white;*/
             background-color: #ffd802 !important;color:white;
        }

        .gradient-45deg-indigo-light-blue
        {
           /* background-image: linear-gradient(45deg, #3949ab, #4fc3f7) !important;
            color:white;*/
             background-color: #67AECA !important;color:white;

        }

        .gradient-45deg-green-teal
        {
            /*background-image: linear-gradient(45deg, #43a047, #1de9b6) !important;
            color:white;*/

            background-color: #675682  !important;color:white;
        }
        .gradient-45deg-green-teal2
        {
            /*background-image: linear-gradient(45deg, #43a047, #1de9b6) !important;
            color:white;*/

            background-color: #841983    !important;color:white;
        }

        .gradient-45deg-orage-orange
        {
            background-image: linear-gradient(45deg, #bf360c, #f57c00) !important;
            color:white;
        }

        .border-radius-6
        {
            border-radius: 6px !important;
        }

        .gradient-45deg-purple-deep-orange {
            background: #8e24aa;
            background: -webkit-linear-gradient(45deg, #8e24aa, #ff6e40) !important;
            background-image: linear-gradient(45deg, #8e24aa, #ff6e40) !important;
            color:white;
        }
         .gradient-45deg-purple-deep-orange2 {
             background-color: #fddf2b    !important;color:white;
        }
        .white-text
        {
            color:white !important;
            padding-left: 10px;
        }
        .gradient-45deg-blue-indigo {
            background: #2962ff;
            background: -webkit-linear-gradient(45deg, #2962ff, #3949ab) !important;
            background: linear-gradient(45deg, #2962ff, #3949ab) !important;            
            color:white;
        }
        .gradient-45deg-blue-indigo2 {
             background-color: #0B3C5D   !important;color:white;
        }
        .gradient-45deg-deep-orange-orange {
            background: #bf360c;
            background: -webkit-linear-gradient(45deg, #bf360c, #f57c00) !important;
            background: linear-gradient(45deg, #bf360c, #f57c00) !important;
            color:white;
        }
        .gradient-45deg-deep-orange-orange2 {
            background-color: #B82602   !important;color:white;
        }
        .background-round {
            padding: 15px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, .18);
        }
        .cyan {
            background-color: #00bcd4 !important;color:white;
        }
        .blue {
            background-color: #2196f3 !important;color:white;
        }
        .green {
            background-color: #4caf50 !important;color:white;
        }
        .red {
            background-color: #f44336 !important;color:white;
        }
        .chip {
            font-size: 13px;
            margin-right: 5px;
            padding: 7px 13px 7px 13px;
            color: rgba(0, 0, 0, .6);
            border-radius: 16px;
            background-color: #e4e4e4;
        }
        .green.lighten-5 {
            background-color: #92f7a6 !important;
        }
        .green-text
        {
            color:#4caf50 !important;
        }
        .redonot
        {
            width: 530px !important;
            overflow-y: auto;
            height: 40vh;
        }
        .purple {
            background-color: #5F0F4E !important;color:white;
        }
        .mockup-result{
            width: 77 vw;
            /* margin: auto; */
            /* text-align: justify; */
            word-break: break-word;
            white-space: pre-line;
            overflow-wrap: break-word;
        }



        

    </style>

<body class="main" style="background-color: #616161;">
              
        <div class="flex">
           
                 <div class="content">
               
                 @yield('content')
                
               
            </div>
            
        </div>
        
        
         
     <script src="{{asset('overide/web/themes/apim/default/js/vendors.min.js')}}"></script>
    
    <script src="{{asset('overide/web/themes/apim/default/vendors/sparkline/jquery.sparkline.min.js')}}"></script>
   

    <script src="{{asset('overide/web/themes/apim/default/js/custom/custom-script.js')}}"></script>

   

    <script src="{{asset('overide/web/themes/apim/assets/js/jquery.blockUI.min.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/js/scripts/app-contacts.js')}}"></script>

    <script src="{{asset('overide/web/themes/apim/default/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/js/search.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/js/scripts/form-select2.js')}}"></script>

    <script src="{{asset('overide/web/themes/apim/default/vendors/jQuery-Mapael-2.2.0/js/jquery.mapael.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/raphael.min.js')}}"></script>
    <!-- <script src="{{asset('overide/web/themes/apim/default/vendors/jQuery-Mapael-2.2.0/js/maps/malaysia.js')}}"></script> -->
    <script src="{{asset('overide/web/themes/apim/default/vendors/sweetalert/sweetalert.min.js')}}"></script>

    <script src="{{asset('overide/web/themes/apim/default/js/scripts/advance-ui-modals.js')}}"></script>


    <script src="{{asset('overide/web/themes/apim/default/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/js/scripts/data-tables.js')}}"></script>

    <script src="{{asset('overide/web/themes/apim/default/vendors/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/js/scripts/form-select2.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.js"></script>
   

    <script src="{{asset('overide/web/themes/apim/default/vendors/redactor/redactor.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/redactor/plugins/table.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/redactor/plugins/source.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/redactor/plugins/fontcolor.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/redactor/plugins/alignment/alignment.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/redactor/plugins/clips/clips.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/redactor/plugins/video.js')}}"></script>
    
    <script src="{{asset('overide/web/themes/apim/default/vendors/quill/katex.min.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/quill/highlight.min.js')}}"></script>
    <script src="{{asset('overide/web/themes/apim/default/vendors/quill/quill.min.js')}}"></script>

    <script src="{{asset('overide/web/themes/apim/assets/js/app.js')}}"></script>



    <script type="text/javascript" src="{{asset('overide/web/themes/apim/default/vendors/redactor/plugins/fontSize.js') }}"></script> 
<!-- <script type="text/javascript" src="https://unpkg.com/tabulator-tables/dist/js/tabulator.min.js"></script> -->
    <script type="text/javascript" src="{{asset('overide/web/themes/apim/assets/js/tabulator.min.js')}}"></script> 

           <script type="text/javascript">

    $('#content').redactor({
        plugins : ['source','table','video','alignment','fontcolor','fontsize'],
        minHeight: '300px',
        maxHeight: '800px'
    });

    </script>


    @stack('script')


        <!-- END: JS Assets-->
    </body>

</html>