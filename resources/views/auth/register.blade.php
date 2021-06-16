@extends('layouts.guest.index')
@section('style')
<style>
li.active > a.hidden-xs {
 display: block!important;
}
li.active > a.visible-xs {
	display: none!important; 
}
.nav-pills.nav-wizard > li {
  position: relative;
  overflow: visible;
  border-right: 10px solid #fff;
  border-left: 10px solid #fff;
}
.nav-pills.nav-wizard > li:first-child {
  border-left: 0;
}
.nav-pills.nav-wizard > li:first-child a {
  border-radius: 5px 0 0 5px;
}
.nav-pills.nav-wizard > li:last-child {
  border-right: 0;
}
.nav-pills.nav-wizard > li:last-child a {
  border-radius: 0 5px 5px 0;
}
.nav-pills.nav-wizard > li a {
  border-radius: 0;
  background-color: #eee;
  padding: 10px;
}
.nav-pills.nav-wizard > li .nav-arrow {
  position: absolute;
  top: 0px;
  right: -20px;
  width: 0px;
  height: 0px;
  border-style: solid;
  border-width: 20px 0 20px 20px;
  border-color: transparent transparent transparent #eee;
  z-index: 150;
}
.nav-pills.nav-wizard > li .nav-wedge {
  position: absolute;
  top: 0px;
  left: -20px;
  width: 0px;
  height: 0px;
  border-style: solid;
  border-width: 20px 0 20px 20px;
  border-color: #eee #eee #eee transparent;
  z-index: 150;
}
.nav-pills.nav-wizard > li:hover .nav-arrow {
  border-color: transparent transparent transparent #aaa;
}
.nav-pills.nav-wizard > li:hover .nav-wedge {
  border-color: #aaa #aaa #aaa transparent;
}
.nav-pills.nav-wizard > li:hover a {
  background-color: #aaa;
  color: #fff;
}
.nav-pills.nav-wizard > li.active .nav-arrow {
  border-color: transparent transparent transparent #428bca;
}
.nav-pills.nav-wizard > li.active .nav-wedge {
  border-color: #428bca #428bca #428bca transparent;
}
.nav-pills.nav-wizard > li.active a {
  background-color: #428bca;
}
/* CSS for Credit Card Payment form */
.credit-card-box .panel-title {
    display: inline;
    font-weight: bold;	
}
.credit-card-box .form-control.error {
    border-color: red;
    outline: 0;
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
}
.credit-card-box label.error {
  font-weight: bold;
  color: red;
  padding: 2px 8px;
  margin-top: 2px;
}
.credit-card-box .payment-errors {
  font-weight: bold;
  color: red;
  padding: 2px 8px;
  margin-top: 2px;
}
.credit-card-box label {
    display: block;
}

.credit-card-box .display-tr {
    display: table-row;
}
.credit-card-box .display-td {
    display: table-cell;
    vertical-align: middle;
    width: 50%;
}
/* Just looks nicer */
.credit-card-box .panel-heading img {
    min-width: 180px;
}
</style>
@endsection
@section('content')
<div class="container bg-white" id="myWizard">
  <div class="row">
      <div class="col-xs-10 col-md-10">
        <h3><span class="glyphicon glyphicon-lock"></span>&nbsp;ลงทะเบียน</h3>
      </div>
    <div class="col-xs-2 col-md-2 pull-right"><img src="https://trustsealinfo.websecurity.norton.com/images/vseal.gif"></div>
  </div>
  <hr>
  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 25%;">
      Step 1 of 4
    </div>
  </div>
  <div class="navbar">
    <div class="navbar-inner">
            <ul class="nav nav-pills nav-wizard">
                <li class="active">
                    <a class="d-none d-sm-block" href="#step1" data-toggle="tab" data-step="1">1. ข้อมูลหน่วยงาน</a>
                    <a class="d-block d-sm-none" href="#step1" data-toggle="tab" data-step="1">1.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="disabled">
                    <div class="nav-wedge"></div>
                    <a class="d-none d-sm-block" href="#step2" data-toggle="tab" data-step="2">2. ข้อมูลผู้รับบริการ
                    </a>
                    <a class="d-block d-sm-none" href="#step2" data-toggle="tab" data-step="2">2.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="disabled">
                    <div class="nav-wedge"></div>
                    <a class="d-none d-sm-block" href="#step3" data-toggle="tab" data-step="3">3. ข้อมูลติดต่อ
                    </a>
                    <a class="d-block d-sm-none" href="#step3" data-toggle="tab" data-step="3">3.</a>
                    <div class="nav-arrow"></div>
                </li>
                <li class="disabled">
                    <div class="nav-wedge"></div>
                    <a class="d-none d-sm-block" href="#step4" data-toggle="tab" data-step="4">4. บัญชีผู้ใช้
                    </a>
                    <a class="d-block d-sm-none" href="#step4" data-toggle="tab" data-step="4">4.</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="step1">
            <h3>1. Details</h3>
            <div class="well">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group ">
                            <label>Email</label>
                            <input class="form-control input-lg" placeholder="Email">
                            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                            <span id="inputError2Status" class="sr-only">(error)</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control input-lg">
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 pull-right">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control input-lg">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-13">
                        <div class="form-group">
                            <label>Address</label>
                            <input class="form-control input-lg">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-7 col-md-7">
                        <div class="form-group">
                            <label>Suburb</label>
                            <input class="form-control input-lg">
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-5 pull-right">
                        <div class="form-group">
                            <label>Postcode</label>
                            <input class="form-control input-lg">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-7 col-md-7">
                        <div class="form-group">
                            <label>State</label>
                            <select id="billing:region_id" name="billing[region_id]" title="State/Province" class="form-control  input-lg validate-select required-entry" defaultvalue="">
                                <option value="">Please select region, state or province</option>
                                <option value="485">Australia Capital Territory</option>
                                <option value="486">New South Wales</option>
                                <option value="487">Northern Territory</option>
                                <option value="488">Queensland</option>
                                <option value="489">South Australia</option>
                                <option value="490">Tasmania</option>
                                <option value="491">Victoria</option>
                                <option value="492">Western Australia</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-5 col-md-5 pull-right">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" class="form-control input-lg" placeholder="(  ) ">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block next" type="submit">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="step2">
            <h3>2. Shipping</h3>
            <div class="well">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <h3>Shipping To</h3>
                        <address>
                            <strong id="customer-name"></strong><br>
                            <div id="address-line1"></div>
                            <div id="address-line2"></div>
                            <abbr title="Phone">P:</abbr> ( ) 
                            <a href="mailto:#"></a>
                        </address>
                    </div>
                </div>
                <div>
                    <dl class="sp-methods">
                        <dt>Express Shipping</dt>
                        <dd>
                            <ul>
                                <li>
                                    <input name="shipping_method" type="radio" value="flatrate2_flatrate2" id="s_method_flatrate2_flatrate2" class="radio">
                                    <label for="s_method_flatrate2_flatrate2">1-2 Business Days                                                                                                 <span class="price">$14.95</span>                                                            </label>
                                </li>
                            </ul>
                        </dd>
                        <dt>Standard Shipping </dt>
                        <dd>
                            <ul>
                                <li>
                                    <input name="shipping_method" type="radio" value="flatrate_flatrate" id="s_method_flatrate_flatrate" class="radio">
                                    <label for="s_method_flatrate_flatrate">2-4 Business Days                                                                                                 <span class="price">$9.95</span>                                                            </label>
                                </li>
                            </ul>
                        </dd>
                    </dl>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <p>It is our priority to deliver your order as quickly as possible, which is why we offer same day dispatch on orders placed before 12:00pm AEST Monday to Friday.<br>
                            Any order placed after 12:00pm AEST or on a weekend will be dispatched the next business day.</p>
                    </div>
                </div>
              <div class="btn-group btn-group-justified" role="group" aria-label="">
                      <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-default back" type="button"><span class="glyphicon glyphicon-chevron-left">&nbsp;Back</span></button>
                    
                      </div>
                <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-primary btn-lg btn-block next" type="submit">Continue&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="step3">
            <div class="row">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <div class="row display-tr">
                            <h3 class="panel-title display-td">Payment Details</h3>
                            <div class="display-td">
                                <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="payment-form">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="cardNumber">CARD NUMBER</label>
                                        <div class="input-group">
                                            <input type="tel" class="form-control" name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number" required="" autofocus="">
                                            <span class="input-group-addon">
                                                <i class="fa fa-credit-card"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-7 col-md-7">
                                    <div class="form-group">
                                        <label for="cardExpiry">
                                            <span class="hidden-xs">EXPIRATION</span>
                                            <span class="visible-xs-inline">EXP</span> DATE
                                        </label>
                                        <input type="tel" class="form-control" name="cardExpiry" placeholder="MM / YY" autocomplete="cc-exp" required="">
                                    </div>
                                </div>
                                <div class="col-xs-5 col-md-5 pull-right">
                                    <div class="form-group">
                                        <label for="cardCVC">CV CODE</label>
                                        <input type="tel" class="form-control" name="cardCVC" placeholder="CVC" autocomplete="cc-csc" required="">
                                    </div>
                                </div>
                            </div>
              <div class="btn-group btn-group-justified" role="group" aria-label="">
                      <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-default back" type="button">Back</button>
                    
                      </div>
                <div class="btn-group btn-group-lg" role="group" aria-label="">
                                    <button class="btn btn-primary btn-lg btn-block next" type="submit">Continue</button>
                                </div>
                            </div>
                            <div class="row" style="display:none;">
                                <div class="col-xs-12">
                                    <p class="payment-errors"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="step4">
            <div class="well">
                <h3>4. Review Order</h3> Add another almost done step here..
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <table class="table">
                            <colgroup><col>
                                <col width="1">
                                <col width="1">
                            </colgroup><thead>
                                <tr>
                                    <th class="name">Product Name</th>
                                    <th class="qty">Qty</th>
                                    <th class="total">Subtotal</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td style="" class="a-right" colspan="2">
                                        Tax            </td>
                                    <td style="" class="a-right"><span class="price">$3.18</span></td>
                                </tr>
                                <tr>
                                    <td style="" class="a-right" colspan="2">
                                        Subtotal    </td>
                                    <td style="" class="a-right">
                                        <span class="price">$18.18</span>    </td>
                                </tr>
                                <tr>
                                    <td style="" class="a-right" colspan="2">
                                        Shipping &amp; Handling (Express Shipping - 1-2 Business Days)    </td>
                                    <td style="" class="a-right">
                                        <span class="price">$14.95</span>    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>
                                        <h3 class="product-name">Hulk Singlet Black </h3>
                                        <dl class="item-options">
                                            <dt>Size</dt>
                                            <dd>M                                    </dd>
                                        </dl>
                                    </td>
                                    <td class="a-center">1</td>
                                    <td>
                                        <span class="cart-price">
                                            <span class="price">$20.00</span>                            </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group ">
                            <label>Gift Cards</label>
                            <input class="form-control input-lg" placeholder="XXXXX-XXXX-XXXXX">
                            <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                            <span id="inputError2Status" class="sr-only">(error)</span>
                        </div>
                    </div>

                </div>
    <div class="row">
                  <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                      <label>Sign up for Newsletter</label>
                      <input type="checkbox">
                    </div>
                  </div>
                </div>
              <div class="btn-group btn-group-justified" role="group" aria-label="">
                      <div class="btn-group btn-group-lg" role="group" aria-label="">
                        <button class="btn btn-default back" type="button">Back</button>
                    
                      </div>
                <div class="btn-group btn-group-lg" role="group" aria-label="">
                    <button class="btn btn-success next" type="submit">Place Order</button>
                </div>
              </div>
            </div>

        </div>
    </div></div>


<div id="push"></div>
@endsection
@section('script')
<script>
$('.next').click(function(){

var nextId = $(this).parents('.tab-pane').next().attr("id");
$('[href=#'+nextId+']').tab('show');
return false;

})

$('.back').click(function(){

var prevId = $(this).parents('.tab-pane').prev().attr("id");
$('[href=#'+prevId+']').tab('show');
return false;

})

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

//update progress
var step = $(e.target).data('step');
var percent = (parseInt(step) / 4) * 100;

$('.progress-bar').css({width: percent + '%'});
$('.progress-bar').text("Step " + step + " of 5");

//e.relatedTarget // previous tab

})

$('.first').click(function(){

$('#myWizard a:first').tab('show')

})
// Generated by CoffeeScript 1.8.0

/*
jQuery Credit Card Validator 1.0

Copyright 2012-2015 Pawel Decowski

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software
is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
IN THE SOFTWARE.
*/

(function() {
var $,
  __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

$ = jQuery;

$.fn.validateCreditCard = function(callback, options) {
  var bind, card, card_type, card_types, get_card_type, is_valid_length, is_valid_luhn, normalize, validate, validate_number, _i, _len, _ref;
  card_types = [
    {
      name: 'amex',
      pattern: /^3[47]/,
      valid_length: [15]
    }, {
      name: 'diners_club_carte_blanche',
      pattern: /^30[0-5]/,
      valid_length: [14]
    }, {
      name: 'diners_club_international',
      pattern: /^36/,
      valid_length: [14]
    }, {
      name: 'jcb',
      pattern: /^35(2[89]|[3-8][0-9])/,
      valid_length: [16]
    }, {
      name: 'laser',
      pattern: /^(6304|670[69]|6771)/,
      valid_length: [16, 17, 18, 19]
    }, {
      name: 'visa_electron',
      pattern: /^(4026|417500|4508|4844|491(3|7))/,
      valid_length: [16]
    }, {
      name: 'visa',
      pattern: /^4/,
      valid_length: [16]
    }, {
      name: 'mastercard',
      pattern: /^5[1-5]/,
      valid_length: [16]
    }, {
      name: 'maestro',
      pattern: /^(5018|5020|5038|6304|6759|676[1-3])/,
      valid_length: [12, 13, 14, 15, 16, 17, 18, 19]
    }, {
      name: 'discover',
      pattern: /^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)/,
      valid_length: [16]
    }
  ];
  bind = false;
  if (callback) {
    if (typeof callback === 'object') {
      options = callback;
      bind = false;
      callback = null;
    } else if (typeof callback === 'function') {
      bind = true;
    }
  }
  if (options == null) {
    options = {};
  }
  if (options.accept == null) {
    options.accept = (function() {
      var _i, _len, _results;
      _results = [];
      for (_i = 0, _len = card_types.length; _i < _len; _i++) {
        card = card_types[_i];
        _results.push(card.name);
      }
      return _results;
    })();
  }
  _ref = options.accept;
  for (_i = 0, _len = _ref.length; _i < _len; _i++) {
    card_type = _ref[_i];
    if (__indexOf.call((function() {
      var _j, _len1, _results;
      _results = [];
      for (_j = 0, _len1 = card_types.length; _j < _len1; _j++) {
        card = card_types[_j];
        _results.push(card.name);
      }
      return _results;
    })(), card_type) < 0) {
      throw "Credit card type '" + card_type + "' is not supported";
    }
  }
  get_card_type = function(number) {
    var _j, _len1, _ref1;
    _ref1 = (function() {
      var _k, _len1, _ref1, _results;
      _results = [];
      for (_k = 0, _len1 = card_types.length; _k < _len1; _k++) {
        card = card_types[_k];
        if (_ref1 = card.name, __indexOf.call(options.accept, _ref1) >= 0) {
          _results.push(card);
        }
      }
      return _results;
    })();
    for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
      card_type = _ref1[_j];
      if (number.match(card_type.pattern)) {
        return card_type;
      }
    }
    return null;
  };
  is_valid_luhn = function(number) {
    var digit, n, sum, _j, _len1, _ref1;
    sum = 0;
    _ref1 = number.split('').reverse();
    for (n = _j = 0, _len1 = _ref1.length; _j < _len1; n = ++_j) {
      digit = _ref1[n];
      digit = +digit;
      if (n % 2) {
        digit *= 2;
        if (digit < 10) {
          sum += digit;
        } else {
          sum += digit - 9;
        }
      } else {
        sum += digit;
      }
    }
    return sum % 10 === 0;
  };
  is_valid_length = function(number, card_type) {
    var _ref1;
    return _ref1 = number.length, __indexOf.call(card_type.valid_length, _ref1) >= 0;
  };
  validate_number = (function(_this) {
    return function(number) {
      var length_valid, luhn_valid;
      card_type = get_card_type(number);
      luhn_valid = false;
      length_valid = false;
      if (card_type != null) {
        luhn_valid = is_valid_luhn(number);
        length_valid = is_valid_length(number, card_type);
      }
      return {
        card_type: card_type,
        valid: luhn_valid && length_valid,
        luhn_valid: luhn_valid,
        length_valid: length_valid
      };
    };
  })(this);
  validate = (function(_this) {
    return function() {
      var number;
      number = normalize($(_this).val());
      return validate_number(number);
    };
  })(this);
  normalize = function(number) {
    return number.replace(/[ -]/g, '');
  };
  if (!bind) {
    return validate();
  }
  this.on('input.jccv', (function(_this) {
    return function() {
      $(_this).off('keyup.jccv');
      return callback.call(_this, validate());
    };
  })(this));
  this.on('keyup.jccv', (function(_this) {
    return function() {
      return callback.call(_this, validate());
    };
  })(this));
  callback.call(this, validate());
  return this;
};

}).call(this);    
</script>
@endsection