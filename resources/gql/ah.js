import gql from 'graphql-tag'

const productsQuery = gql`
    query Products {
        products {
            id
            title
            link
            image
            brand
            category
            price
            discount
            created_at
            updated_at
        }
    }`

const fetchedTaxonomiesQuery = gql`
    query FetchedTaxonomies {
        taxonomies (fetched: true) {
            id
            name
            slugified_name
            created_at
            updated_at
        }
    }`

const productQuery = gql`
    query Product ($id: ID!) {
        product (id: $id) {
            id
            title
            link
            image
            brand
            category
            price {
                unitInfo {
                    price
                    description
                }
                now
                unitSize
                theme
                was
            }
            discount {
                bonusType
                segmentType
                promotionType
                theme
                startDate
                endDate
            }
            taxonomies {
                id
                name
                created_at
                updated_at
            }
            created_at
            updated_at
        }
    }`

const taxonomyQuery = gql`
    query Taxonomy ($id: ID!) {
        taxonomy (id: $id) {
            id
            name
            created_at
            updated_at
            products {
                id
                title
                link
                image
                brand
                category
                price {
                    unitInfo {
                        price
                        description
                    }
                    now
                    unitSize
                    theme
                    was
                }
                discount {
                    bonusType
                    segmentType
                    promotionType
                    theme
                    startDate
                    endDate
                }
                created_at
                updated_at
            }
        }
    }`

export {
    productQuery,
    productsQuery,
    taxonomyQuery,
    fetchedTaxonomiesQuery
}
