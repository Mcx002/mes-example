@php
    $basicinforules = route('management_size')==$actual_link||route('management_model')==$actual_link||route('management_part')==$actual_link||route('management_op')==$actual_link||route('management_line')==$actual_link||route('management_bom')==$actual_link||route('management_leadtime')==$actual_link||route('management_routing')==$actual_link;
    $transactionrules = route('management_transaction')==$actual_link||route('management_defect')==$actual_link;
@endphp
<ul id="sidebarnav">
    <li> <a class="waves-effect waves-dark {{ route('management_home')==$actual_link?'active':'' }}" href="{{ route('management_home')==$actual_link?'javascript:void(0)':route('management_home') }}" aria-expanded="false"><i class="icon-home"></i><span class="hide-menu">Dashboard</span></a>
    </li>
    <li> <a class="waves-effect waves-dark {{ route('management_workorder')==$actual_link?'active':'' }}" href="{{ route('management_workorder')==$actual_link?'javascript:void(0)':route('management_workorder') }}" aria-expanded="false"><i class="ti-clipboard"></i><span class="hide-menu">Work Order</span></a>
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark {{ $basicinforules?'active':'' }}" href="javascript:void(0)" aria-expanded="false"><i class="icon-info"></i><span class="hide-menu">Basic Information</span></a>
        <ul aria-expanded="false" class="collapse {{ $basicinforules?'in':'' }}">
            <li> <a class="waves-effect waves-dark {{ route('management_bom')==$actual_link?'active':'' }}" href="{{ route('management_bom')==$actual_link?'javascript:void(0)':route('management_bom') }}" aria-expanded="false"><i class="icon-book-open"></i><span class="hide-menu">BOM</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('management_leadtime')==$actual_link?'active':'' }}" href="{{ route('management_leadtime')==$actual_link?'javascript:void(0)':route('management_leadtime') }}" aria-expanded="false"><i class="icon-clock"></i><span class="hide-menu">Lead Time</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('management_routing')==$actual_link?'active':'' }}" href="{{ route('management_routing')==$actual_link?'javascript:void(0)':route('management_routing') }}" aria-expanded="false"><i class="icon-vector"></i><span class="hide-menu">Routing</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('management_line')==$actual_link?'active':'' }}" href="{{ route('management_line')==$actual_link?'javascript:void(0)':route('management_line') }}" aria-expanded="false"><i class="icon-graph"></i><span class="hide-menu">Line</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('management_op')==$actual_link?'active':'' }}" href="{{ route('management_op')==$actual_link?'javascript:void(0)':route('management_op') }}" aria-expanded="false"><i class="icon-settings"></i><span class="hide-menu">Operation</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('management_part')==$actual_link?'active':'' }}" href="{{ route('management_part')==$actual_link?'javascript:void(0)':route('management_part') }}" aria-expanded="false"><i class="icon-puzzle"></i><span class="hide-menu">Part</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('management_model')==$actual_link?'active':'' }}" href="{{ route('management_model')==$actual_link?'javascript:void(0)':route('management_model') }}" aria-expanded="false"><i class="icon-heart"></i><span class="hide-menu">Model</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('management_size')==$actual_link?'active':'' }}" href="{{ route('management_size')==$actual_link?'javascript:void(0)':route('management_size') }}" aria-expanded="false"><i class="icon-size-fullscreen"></i><span class="hide-menu">Size</span></a>    
            </li>
        </ul>
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark {{ $transactionrules?'active':'' }}" href="javascript:void(0)" aria-expanded="false"><i class="icon-folder-alt"></i><span class="hide-menu">Transaction</span></a>
        <ul aria-expanded="false" class="collapse {{ $transactionrules?'in':'' }}">
            <li> <a class="waves-effect waves-dark {{ route('management_transaction')==$actual_link?'active':'' }}" href="{{ route('management_transaction')==$actual_link?'javascript:void(0)':route('management_transaction') }}" aria-expanded="false"><i class="icon-star"></i><span class="hide-menu">Complete Transaction</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('management_defect')==$actual_link?'active':'' }}" href="{{ route('management_defect')==$actual_link?'javascript:void(0)':route('management_defect') }}" aria-expanded="false"><i class="ti ti-heart-broken"></i><span class="hide-menu">Defect Transaction</span></a>    
            </li>
        </ul>
    </li>
    {{-- <li> <a class="waves-effect waves-dark {{ route('management_process')==$actual_link?'active':'' }}" href="{{ route('management_process')==$actual_link?'javascript:void(0)':route('management_process') }}" aria-expanded="false"><i class="ti-agenda"></i><span class="hide-menu">Process</span></a>
    </li>
    <li> <a class="waves-effect waves-dark {{ route('management_assy')==$actual_link?'active':'' }}" href="{{ route('management_assy')==$actual_link?'javascript:void(0)':route('management_assy') }}" aria-expanded="false"><i class="icon-layers"></i><span class="hide-menu">Assembly</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('management_workorder')==$actual_link?'active':'' }}" href="{{ route('management_workorder')==$actual_link?'javascript:void(0)':route('management_workorder') }}" aria-expanded="false"><i class="ti-clipboard"></i><span class="hide-menu">Work Order</span></a>    
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark {{ route('management_part')==$actual_link||route('management_style')==$actual_link||route('management_size')==$actual_link?'active':'' }}" href="javascript:void(0)" aria-expanded="false"><i class="icon-settings"></i><span class="hide-menu">Model</span></a>
        <ul aria-expanded="false" class="collapse {{ route('management_part')==$actual_link||route('management_style')==$actual_link||route('management_size')==$actual_link?'in':'' }}">
            <li><a href="{{ route('management_part')==$actual_link?'javascript:void(0)':route('management_part') }}" class="{{ route('management_part')==$actual_link?'active':'' }}">Part <i class="ti ti-layers-alt"></i></a></li>
            <li><a href="{{ route('management_style')==$actual_link?'javascript:void(0)':route('management_style') }}" class="{{ route('management_style')==$actual_link?'active':'' }}">Style <i class="ti ti-heart"></i></a></li>
            <li><a href="{{ route('management_size')==$actual_link?'javascript:void(0)':route('management_size') }}" class="{{ route('management_size')==$actual_link?'active':'' }}">Size <i class="mdi mdi-arrow-expand-all"></i></a></li>
        </ul>
    </li>
    <li> <a class="waves-effect waves-dark {{ route('management_m_routing')==$actual_link?'active':'' }}" href="{{ route('management_m_routing')==$actual_link?'javascript:void(0)':route('management_m_routing') }}" aria-expanded="false"><i class="icon-vector"></i><span class="hide-menu">Master Routing</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('management_line')==$actual_link?'active':'' }}" href="{{ route('management_line')==$actual_link?'javascript:void(0)':route('management_line') }}" aria-expanded="false"><i class="icon-shuffle"></i><span class="hide-menu">Line</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('management_prod_plan')==$actual_link?'active':'' }}" href="{{ route('management_prod_plan')==$actual_link?'javascript:void(0)':route('management_prod_plan') }}" aria-expanded="false"><i class="icon-note"></i><span class="hide-menu">Production Plan</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('management_defect')==$actual_link?'active':'' }}" href="{{ route('management_defect')==$actual_link?'javascript:void(0)':route('management_defect') }}" aria-expanded="false"><i class="icon-note"></i><span class="hide-menu">Defect</span></a>    
    </li>
    <li> <a class="waves-effect waves-dark {{ route('management_defectname')==$actual_link?'active':'' }}" href="{{ route('management_defectname')==$actual_link?'javascript:void(0)':route('management_defectname') }}" aria-expanded="false"><i class="icon-note"></i><span class="hide-menu">Defect Name</span></a>    
    </li> --}}
    <li class="nav-small-cap"></li>
    {{-- <li> <a class="waves-effect waves-dark" href="http://www.wrappixel.com/demos/admin-templates/elegant-admin/documentation/documentation.html" aria-expanded="false"><i class="fa fa-circle-o text-danger"></i><span class="hide-menu">Documentation</span></a></li> --}}
    <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" aria-expanded="false"><i class="icon-logout"></i><span class="hide-menu">Log Out</span></a></li>
    {{-- <li> <a class="waves-effect waves-dark" href="pages-faq.html" aria-expanded="false"><i class="fa fa-circle-o text-info"></i><span class="hide-menu">FAQs</span></a></li> --}}
</ul>