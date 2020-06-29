@php
// rules group
    $basicinforules = route('kr_admin_size')==$actual_link||route('kr_admin_model')==$actual_link||route('kr_admin_part')==$actual_link||route('kr_admin_op')==$actual_link||route('kr_admin_line')==$actual_link||route('kr_admin_bom')==$actual_link||route('kr_admin_leadtime')==$actual_link||route('kr_admin_routing')==$actual_link;
    $defectrules = route('kr_admin_defect_master')==$actual_link||route('kr_admin_defect_info')==$actual_link||route('kr_admin_defect')==$actual_link;
    $transactioninforules = route('kr_admin_production_info')==$actual_link||route('kr_admin_wip_info')==$actual_link||route('kr_admin_transaction_info')==$actual_link||route('kr_admin_defect_info')==$actual_link; 
@endphp
    <li> <a class="waves-effect waves-dark {{ route('kr_admin_home')==$actual_link?'active':'' }}" href="{{ route('kr_admin_home')==$actual_link?'javascript:void(0)':route('kr_admin_home') }}" aria-expanded="false"><i class="icon-home"></i><span class="hide-menu">대시 보드</span></a>
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_admin_workorder')==$actual_link?'active':'' }}" href="{{ route('kr_admin_workorder')==$actual_link?'javascript:void(0)':route('kr_admin_workorder') }}" aria-expanded="false"><i class="ti-clipboard"></i><span class="hide-menu">Work Order</span></a>
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark {{ $basicinforules?'active':'' }}" href="javascript:void(0)" aria-expanded="false"><i class="icon-info"></i><span class="hide-menu">기본 정보</span></a>
        <ul aria-expanded="false" class="collapse {{ $basicinforules?'in':'' }}">
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_bom')==$actual_link?'active':'' }}" href="{{ route('kr_admin_bom')==$actual_link?'javascript:void(0)':route('kr_admin_bom') }}" aria-expanded="false"><i class="icon-book-open"></i><span class="hide-menu">BOM</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_leadtime')==$actual_link?'active':'' }}" href="{{ route('kr_admin_leadtime')==$actual_link?'javascript:void(0)':route('kr_admin_leadtime') }}" aria-expanded="false"><i class="icon-clock"></i><span class="hide-menu">Lead Time</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_routing')==$actual_link?'active':'' }}" href="{{ route('kr_admin_routing')==$actual_link?'javascript:void(0)':route('kr_admin_routing') }}" aria-expanded="false"><i class="icon-vector"></i><span class="hide-menu">Routing</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_line')==$actual_link?'active':'' }}" href="{{ route('kr_admin_line')==$actual_link?'javascript:void(0)':route('kr_admin_line') }}" aria-expanded="false"><i class="icon-graph"></i><span class="hide-menu">Line</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_op')==$actual_link?'active':'' }}" href="{{ route('kr_admin_op')==$actual_link?'javascript:void(0)':route('kr_admin_op') }}" aria-expanded="false"><i class="icon-settings"></i><span class="hide-menu">Operation</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_part')==$actual_link?'active':'' }}" href="{{ route('kr_admin_part')==$actual_link?'javascript:void(0)':route('kr_admin_part') }}" aria-expanded="false"><i class="icon-puzzle"></i><span class="hide-menu">Part</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_model')==$actual_link?'active':'' }}" href="{{ route('kr_admin_model')==$actual_link?'javascript:void(0)':route('kr_admin_model') }}" aria-expanded="false"><i class="icon-heart"></i><span class="hide-menu">Model</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_size')==$actual_link?'active':'' }}" href="{{ route('kr_admin_size')==$actual_link?'javascript:void(0)':route('kr_admin_size') }}" aria-expanded="false"><i class="icon-size-fullscreen"></i><span class="hide-menu">Size</span></a>    
            </li>
        </ul>
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_admin_transaction')==$actual_link?'active':'' }}" href="{{ route('kr_admin_transaction')==$actual_link?'javascript:void(0)':route('kr_admin_transaction') }}" aria-expanded="false"><i class="icon-star"></i><span class="hide-menu">완료 트랜잭션</span></a>    
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark {{ $defectrules?'active':'' }}" href="javascript:void(0)" aria-expanded="false"><i class="ti ti-receipt"></i><span class="hide-menu">불량</span></a>
        <ul  aria-expanded="false" class="collapse {{ $defectrules?'in':'' }}">
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_defect_info')==$actual_link?'active':'' }}" href="{{ route('kr_admin_defect_info')==$actual_link?'javascript:void(0)':route('kr_admin_defect_info') }}" aria-expanded="false"><i class="icon-fire"></i><span class="hide-menu">불량 정보</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_defect_master')==$actual_link?'active':'' }}" href="{{ route('kr_admin_defect_master')==$actual_link?'javascript:void(0)':route('kr_admin_defect_master') }}" aria-expanded="false"><i class="ti ti-write"></i><span class="hide-menu">불량 마스터</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_defect')==$actual_link?'active':'' }}" href="{{ route('kr_admin_defect')==$actual_link?'javascript:void(0)':route('kr_admin_defect') }}" aria-expanded="false"><i class="ti ti-heart-broken"></i><span class="hide-menu">불량 트랜잭션</span></a>    
            </li>
        </ul>
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark {{ $transactioninforules?'active':'' }}" href="javascript:void(0)" aria-expanded="false"><i class="icon-map"></i><span class="hide-menu">Info Transaction</span></a>
        <ul aria-expanded="false" class="collapse {{ $transactioninforules?'in':'' }}">
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_transaction_info')==$actual_link?'active':'' }}" href="{{ route('kr_admin_transaction_info')==$actual_link?'javascript:void(0)':route('kr_admin_transaction_info') }}" aria-expanded="false"><i class="icon-layers"></i><span class="hide-menu">Transaction</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_wip_info')==$actual_link?'active':'' }}" href="{{ route('kr_admin_wip_info')==$actual_link?'javascript:void(0)':route('kr_admin_wip_info') }}" aria-expanded="false"><i class="icon-rocket"></i><span class="hide-menu">WIP</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_admin_production_info')==$actual_link?'active':'' }}" href="{{ route('kr_admin_production_info')==$actual_link?'javascript:void(0)':route('kr_admin_production_info') }}" aria-expanded="false"><i class="icon-drawar"></i><span class="hide-menu">Production Info</span></a>    
            </li>
        </ul>
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_admin_users')==$actual_link?'active':'' }}" href="{{ route('kr_admin_users')==$actual_link?'javascript:void(0)':route('kr_admin_users') }}" aria-expanded="false"><i class="ti ti-user"></i><span class="hide-menu">사용자 관리</span></a>
    </li>
    {{-- <li> <a class="waves-effect waves-dark {{ route('kr_management_process')==$actual_link?'active':'' }}" href="{{ route('kr_management_process')==$actual_link?'javascript:void(0)':route('kr_management_process') }}" aria-expanded="false"><i class="ti-agenda"></i><span class="hide-menu">Process</span></a>
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_management_assy')==$actual_link?'active':'' }}" href="{{ route('kr_management_assy')==$actual_link?'javascript:void(0)':route('kr_management_assy') }}" aria-expanded="false"><i class="icon-layers"></i><span class="hide-menu">Assembly</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_management_workorder')==$actual_link?'active':'' }}" href="{{ route('kr_management_workorder')==$actual_link?'javascript:void(0)':route('kr_management_workorder') }}" aria-expanded="false"><i class="ti-clipboard"></i><span class="hide-menu">Work Order</span></a>    
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark {{ route('kr_management_part')==$actual_link||route('kr_management_style')==$actual_link||route('kr_management_size')==$actual_link?'active':'' }}" href="javascript:void(0)" aria-expanded="false"><i class="icon-settings"></i><span class="hide-menu">Model</span></a>
        <ul aria-expanded="false" class="collapse {{ route('kr_management_part')==$actual_link||route('kr_management_style')==$actual_link||route('kr_management_size')==$actual_link?'in':'' }}">
            <li><a href="{{ route('kr_management_part')==$actual_link?'javascript:void(0)':route('kr_management_part') }}" class="{{ route('kr_management_part')==$actual_link?'active':'' }}">Part <i class="ti ti-layers-alt"></i></a></li>
            <li><a href="{{ route('kr_management_style')==$actual_link?'javascript:void(0)':route('kr_management_style') }}" class="{{ route('kr_management_style')==$actual_link?'active':'' }}">Style <i class="ti ti-heart"></i></a></li>
            <li><a href="{{ route('kr_management_size')==$actual_link?'javascript:void(0)':route('kr_management_size') }}" class="{{ route('kr_management_size')==$actual_link?'active':'' }}">Size <i class="mdi mdi-arrow-expand-all"></i></a></li>
        </ul>
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_management_m_routing')==$actual_link?'active':'' }}" href="{{ route('kr_management_m_routing')==$actual_link?'javascript:void(0)':route('kr_management_m_routing') }}" aria-expanded="false"><i class="icon-vector"></i><span class="hide-menu">Master Routing</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_management_line')==$actual_link?'active':'' }}" href="{{ route('kr_management_line')==$actual_link?'javascript:void(0)':route('kr_management_line') }}" aria-expanded="false"><i class="icon-shuffle"></i><span class="hide-menu">Line</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_management_prod_plan')==$actual_link?'active':'' }}" href="{{ route('kr_management_prod_plan')==$actual_link?'javascript:void(0)':route('kr_management_prod_plan') }}" aria-expanded="false"><i class="icon-note"></i><span class="hide-menu">Production Plan</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_management_defect')==$actual_link?'active':'' }}" href="{{ route('kr_management_defect')==$actual_link?'javascript:void(0)':route('kr_management_defect') }}" aria-expanded="false"><i class="icon-note"></i><span class="hide-menu">Defect</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_management_defectname')==$actual_link?'active':'' }}" href="{{ route('kr_management_defectname')==$actual_link?'javascript:void(0)':route('kr_management_defectname') }}" aria-expanded="false"><i class="icon-note"></i><span class="hide-menu">Defect Name</span></a>    
    </li> --}}
    <li class="nav-small-cap"></li>
    {{-- <li> <a class="waves-effect waves-dark" href="http://www.wrappixel.com/demos/admin-templates/elegant-admin/documentation/documentation.html" aria-expanded="false"><i class="fa fa-circle-o text-danger"></i><span class="hide-menu">Documentation</span></a></li> --}}
    {{-- <li> <a class="waves-effect waves-dark" href="pages-faq.html" aria-expanded="false"><i class="fa fa-circle-o text-info"></i><span class="hide-menu">FAQs</span></a></li> --}}
