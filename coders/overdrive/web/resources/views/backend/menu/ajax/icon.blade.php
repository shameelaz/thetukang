 <script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
 <div class="modal-body p-10 text-left" style="height: 60%;overflow-x: scroll;"> 
    <div class="font-medium text-base mr-auto"> <i data-feather="bookmark"></i>
       @lang('web::page.changeicon')
    </div>
  <br>
  <hr>
  <br>
  <br>
  @foreach($icons as $iconlist)

    <a href="/menu/icon/{{$id}}/{{$iconlist}}" style="margin:10px !important;"><i data-feather="{{$iconlist}}" style="height: 40px;width: 40px;"></i>
    </a>

  @endforeach
</div>

      <script>
      feather.replace()
    </script>
