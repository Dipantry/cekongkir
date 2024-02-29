<?php

namespace Dipantry\CekOngkir\Constants;

class Constant
{
    public static string $ongkirQuery = "\"query pricingDomestic(\$payload: ParamPricingDomesticInput!) {\\n pricingDomestic(p: \$payload) {\\n totalCount\\n edges {\\n node {\\n id\\n logistic {\\n id\\n name\\n logoURL\\n code\\n status\\n companyName\\n __typename\\n }\\n rate {\\n name\\n type\\n __typename\\n }\\n totalPrice\\n minDay\\n maxDay\\n finalPrice\\n discountedPrice\\n insuranceFee\\n surchargeFee\\n discountValue\\n __typename\\n }\\n __typename\\n }\\n __typename\\n  }\\n}\"";
}