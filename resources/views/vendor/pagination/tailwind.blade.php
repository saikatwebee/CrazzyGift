<style>
    .custom-ul {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .custom-li {
        padding: 3px;
        margin: 5px;
    }

    /* .custom-number {
       
    } */

    li .active{
        border: 1px solid #ccc6;
        background: #cccccc30;
        border-radius: 10px;
        font-weight: 700;
    }
    .disabled {
        display: none;
    /* pointer-events: none; 
    color: gray;       
    text-decoration: none; 
    cursor: not-allowed;   */
  }
</style>

@if ($paginator->lastPage() > 1)
    <ul class="pagination custom-ul">
        <li class="{{ $paginator->currentPage() == 1 ? ' disabled' : '' }} custom-li">
            <a class="btn btn-info btn-sm text-white" href="{{ $paginator->url($paginator->currentPage() - 1) }}"><i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i> Previous</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ $paginator->currentPage() == $i ? ' active' : '' }} custom-li custom-number">
                <a style="text-decoration:none;color:#3aa2ff;" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }} custom-li">
            <a class="btn btn-info btn-sm text-white" href="{{ $paginator->url($paginator->currentPage() + 1) }}">Next <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></a>
        </li>
    </ul>
@endif
