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
        }

        rate {
          id
          name
          type
        }

        totalPrice
        minDay
        maxDay
        finalPrice
        discountedPrice
        insuranceFee
        surchargeFee
        discountValue
      }
    }
  }
}
EOT;

    public static string $location = <<<EOT
query locationProjection(\$payload: ParamLocationProjectionInput!) {
    locationProjection(p: \$payload) {
        edges {
            node {
                id
                admLevel1 {
                    id
                    shortName
                    longName
                }
                admLevel2 {
                    id
                    shortName
                    longName
                }
                admLevel3 {
                    id
                    shortName
                    longName
                }
                admLevel4 {
                    id
                    shortName
                    longName
                }
                admLevel5 {
                    id
                    shortName
                    longName
                }
            }
        }
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
            }
        }
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
    }
    shipmentDate
    details {
      datetime
      logisticStatus {
        name
        description
      }
    }
    consigner {
      name
      address
    }
    consignee {
      name
      address
    }
  }
}
EOT;
}