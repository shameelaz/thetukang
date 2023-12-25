$(document).ready(function () {
   "use strict";
   /*
    * DataTables - Tables
    */
   var calcDataTableHeight = function () {
      return $(window).height() - 380 + "px";
   };

   var table = $("#data-table-contact").DataTable({
      scrollY: calcDataTableHeight(),
      scrollCollapse: true,
      scrollX: false,
      paging: true,
      responsive: true,
      lengthMenu: [15],
     
      "fnInitComplete": function () {
         var ps_datatable = new PerfectScrollbar('.dataTables_scrollBody');
      },
      //on paginition page 2,3.. often scroll shown, so reset it and assign it again
      "fnDrawCallback": function (oSettings) {
         var ps_datatable = new PerfectScrollbar('.dataTables_scrollBody');
      }
   });

      var table2 = $("#data-table-contact2").DataTable({
      scrollY: calcDataTableHeight(),
      scrollCollapse: true,
      scrollX: false,
      paging: true,
      responsive: true,
      lengthMenu: [15],
     
      "fnInitComplete": function () {
         var ps_datatable = new PerfectScrollbar('.dataTables_scrollBody');
      },
      //on paginition page 2,3.. often scroll shown, so reset it and assign it again
      "fnDrawCallback": function (oSettings) {
         var ps_datatable = new PerfectScrollbar('.dataTables_scrollBody');
      }
   });

   // Custom search
   function filterGlobal() {
      table.search($("#global_filter").val(), $("#global_regex").prop("checked"), $("#global_smart").prop("checked")).draw();
   }

   function filterGlobal2() {
      table2.search($("#global_filter2").val(), $("#global_regex").prop("checked"), $("#global_smart").prop("checked")).draw();
   }


   function filterColumn(i) {
       table
         .column(i)
         .search(
            $("#col" + i + "_filter").val(),
            $("#col" + i + "_regex").prop("checked"),
            $("#col" + i + "_smart").prop("checked")
         )
         .draw();
   }


   function filterColumn2(i) {
      table2
         .column(i)
         .search(
            $("#col" + i + "_filter").val(),
            $("#col" + i + "_regex").prop("checked"),
            $("#col" + i + "_smart").prop("checked")
         )
         .draw();
   }

   $("input#global_filter").on("keyup click", function () {
      filterGlobal();
   });

   $("input.column_filter").on("keyup click", function () {
      filterColumn(
         $(this)
            .parents("tr")
            .attr("data-column")
      );
   });


   $("input#global_filter2").on("keyup click", function () {
      filterGlobal2();
   });

   $("input.column_filter2").on("keyup click", function () {
      filterColumn2(
         $(this)
            .parents("tr")
            .attr("data-column")
      );
   });

   //  Notifications & messages scrollable
   if ($("#sidebar-list").length > 0) {
      var ps_sidebar_list = new PerfectScrollbar("#sidebar-list", {
         theme: "dark"
      });
   }

  

   // Toggle class of sidenav
   $("#contact-sidenav").sidenav({
      onOpenStart: function () {
         $("#sidebar-list").addClass("sidebar-show");
      },
      onCloseEnd: function () {
         $("#sidebar-list").removeClass("sidebar-show");
      }
   });

 

   // Close other sidenav on click of any sidenav
   if ($(window).width() > 900) {
      $("#contact-sidenav").removeClass("sidenav");
   }



   // for rtl
   if ($("html[data-textdirection='rtl']").length > 0) {
      // Toggle class of sidenav
      $("#contact-sidenav").sidenav({
         edge: "right",
         onOpenStart: function () {
            $("#sidebar-list").addClass("sidebar-show");
         },
         onCloseEnd: function () {
            $("#sidebar-list").removeClass("sidebar-show");
         }
      });
   }
});

// Sidenav
$(".sidenav-trigger").on("click", function () {
   if ($(window).width() < 960) {
      $(".sidenav").sidenav("close");
      $(".app-sidebar").sidenav("close");
   }
});



$(window).on("resize", function () {
   resizetable();

   if ($(window).width() > 899) {
      $("#contact-sidenav").removeClass("sidenav");
   }

   if ($(window).width() < 900) {
      $("#contact-sidenav").addClass("sidenav");
   }
});

function resizetable() {
   $(".app-page .dataTables_scrollBody").css({
      maxHeight: $(window).height() - 420 + "px"
   });
}
resizetable();

// For contact sidebar on small screen
if ($(window).width() < 900) {
   $(".sidebar-left.sidebar-fixed").removeClass("animate fadeUp animation-fast");
   $(".sidebar-left.sidebar-fixed .sidebar").removeClass("animate fadeUp");
}
