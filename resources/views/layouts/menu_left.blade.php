<div class="catagories-side-menu">
    <!-- Close Icon -->
    <div id="sideMenuClose">
        <i class="fas fa-times"></i>
    </div>
    <!--  Side Nav  -->
     <div class="nav-side-menu">
        <div class="menu-list">
                <h6>Categories</h6>
                <ul id="menu-content" class="menu-content collapse out">
                    @foreach ( $category as $key => $value )
                    <li data-toggle="collapse" data-target="#women" class="collapsed active">
                        <a href="{{url("productInCategoryId/{$value->id}")}}">{{ $value -> name}}</a>
                    </li>
                    @endforeach
                </ul>
            </form>
        </div>
    </div>
</div>