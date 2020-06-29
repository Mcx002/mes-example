@php
// rules group
    $transactioninforules = route('kr_qualitycontrol_wip_info')==$actual_link||route('kr_qualitycontrol_transaction_info')==$actual_link||route('kr_qualitycontrol_defect_info')==$actual_link||route('kr_qualitycontrol_production_info')==$actual_link; 
    $defectrules = route('kr_qualitycontrol_defect_master')==$actual_link||route('kr_qualitycontrol_defect_info')==$actual_link||route('kr_qualitycontrol_defect')==$actual_link;
@endphp
    <li> <a class="waves-effect waves-dark {{ route('kr_qualitycontrol_home')==$actual_link?'active':'' }}" href="{{ route('kr_qualitycontrol_home')==$actual_link?'javascript:void(0)':route('kr_qualitycontrol_home') }}" aria-expanded="false"><i class="icon-home"></i><span class="hide-menu">대시 보드</span></a>
    </li>
    <li> <a class="waves-effect waves-dark {{ route('kr_qualitycontrol_workorder')==$actual_link?'active':'' }}" href="{{ route('kr_qualitycontrol_workorder')==$actual_link?'javascript:void(0)':route('kr_qualitycontrol_workorder') }}" aria-expanded="false"><i class="ti-clipboard"></i><span class="hide-menu">Work Order</span></a>
    </li>
    
    <li>
        <a class="has-arrow waves-effect waves-dark {{ $defectrules?'active':'' }}" href="javascript:void(0)" aria-expanded="false"><i class="ti ti-receipt"></i><span class="hide-menu">불량</span></a>
        <ul  aria-expanded="false" class="collapse {{ $defectrules?'in':'' }}">
            <li> <a class="waves-effect waves-dark {{ route('kr_qualitycontrol_defect_info')==$actual_link?'active':'' }}" href="{{ route('kr_qualitycontrol_defect_info')==$actual_link?'javascript:void(0)':route('kr_qualitycontrol_defect_info') }}" aria-expanded="false"><i class="icon-fire"></i><span class="hide-menu">Defect Info</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_qualitycontrol_defect_master')==$actual_link?'active':'' }}" href="{{ route('kr_qualitycontrol_defect_master')==$actual_link?'javascript:void(0)':route('kr_qualitycontrol_defect_master') }}" aria-expanded="false"><i class="ti ti-write"></i><span class="hide-menu">Defect Master</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_qualitycontrol_defect')==$actual_link?'active':'' }}" href="{{ route('kr_qualitycontrol_defect')==$actual_link?'javascript:void(0)':route('kr_qualitycontrol_defect') }}" aria-expanded="false"><i class="ti ti-heart-broken"></i><span class="hide-menu">Defect Transaction</span></a>    
            </li>
        </ul>
    </li>
    <li>
        <a class="has-arrow waves-effect waves-dark {{ $transactioninforules?'active':'' }}" href="javascript:void(0)" aria-expanded="false"><i class="icon-map"></i><span class="hide-menu">Info Transaction</span></a>
        <ul aria-expanded="false" class="collapse {{ $transactioninforules?'in':'' }}">
            <li> <a class="waves-effect waves-dark {{ route('kr_qualitycontrol_transaction_info')==$actual_link?'active':'' }}" href="{{ route('kr_qualitycontrol_transaction_info')==$actual_link?'javascript:void(0)':route('kr_qualitycontrol_transaction_info') }}" aria-expanded="false"><i class="icon-layers"></i><span class="hide-menu">Transaction</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_qualitycontrol_wip_info')==$actual_link?'active':'' }}" href="{{ route('kr_qualitycontrol_wip_info')==$actual_link?'javascript:void(0)':route('kr_qualitycontrol_wip_info') }}" aria-expanded="false"><i class="icon-rocket"></i><span class="hide-menu">WIP</span></a>    
            </li>
            <li> <a class="waves-effect waves-dark {{ route('kr_qualitycontrol_production_info')==$actual_link?'active':'' }}" href="{{ route('kr_qualitycontrol_production_info')==$actual_link?'javascript:void(0)':route('kr_qualitycontrol_production_info') }}" aria-expanded="false"><i class="icon-drawar"></i><span class="hide-menu">Production Info</span></a>    
            </li>
        </ul>
    </li>
    <li class="nav-small-cap"></li>
    {{-- <li> <a class="waves-effect waves-dark" href="http://www.wrappixel.com/demos/admin-templates/elegant-admin/documentation/documentation.html" aria-expanded="false"><i class="fa fa-circle-o text-danger"></i><span class="hide-menu">Documentation</span></a></li> --}}