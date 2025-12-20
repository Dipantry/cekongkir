<?php

namespace Dipantry\CekOngkir\Constants;

class Queries
{
    public static string $ongkir = <<<EOT
query pricingDomestic(\$payload: ParamPricingDomesticInput!) {
  pricingDomestic(p: \$payload) {
    totalCount
    edges {
      node {
        id
        logistic {
          id
          name
          logoURL
          code
          status
          companyName
          __typename
        }

        rate {
          name
          type
          __typename
        }

        totalPrice
        minDay
        maxDay
        finalPrice
        discountedPrice
        insuranceFee
        surchargeFee
        discountValue
        __typename
      }
      __typename
    }
    __typename
  }
}
EOT;

    public static string $location = <<<EOT
query locationProjection(\$payload: ParamLocationProjectionInput!) {
    locationProjection(p: \$payload) {
        edges {
            node {
                id
                admLevel2 {
                    longName
                    __typename
                }
                admLevel3 {
                    longName
                    __typename
                }
                admLevel4 {
                    longName
                    __typename
                }
                admLevel5 {
                    longName
                    __typename
                }
                currentAdmLevel {
                    id
                    __typename
                }
                __typename
            }
            __typename
        }
        __typename
    }
}
EOT;

    public static string $logistics = <<<EOT
query logistics(\$payload: ParamLogisticInput) { 
    logistics(p: \$payload) { 
        edges { 
            node { 
                id 
                name 
                code 
                logoURL 
                companyName 
                status
                __typename
            }
            __typename    
        } 
        __typename
    }
}
EOT;

    public static string $logisticsSuggestion = <<<EOT
query logisticRefSuggestion(\$payload: ParamLogisticRefSuggestionInput!) {
    logisticRefSuggestion(p: \$payload)
}
EOT;

    public static string $tracking = <<<EOT
query trackingDirect(\$input: TrackingDirectInput!) {
  trackingDirect(p: \$input) {
    referenceNo
    logistic {
      id
      __typename
    }
    shipmentDate
    details {
      datetime
      shipperStatus {
        name
        description
        __typename
      }
      logisticStatus {
        name
        description
        __typename
      }
      __typename
    }
    consigner {
      name
      address
      __typename
    }
    consignee {
      name
      address
      __typename
    }
    __typename
  }
}
EOT;
}