import gql from 'graphql-tag'

const productsQuery = gql`
    query Products {
        products {
            data {
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
            paginatorInfo {
                count
                currentPage
                lastPage
            }
        }
    }`

const taxonomiesQuery = gql`
    query Taxonomies {
        taxonomies {
            data {
                id
                name
                created_at
                updated_at
            }
            paginatorInfo {
                count
                currentPage
                lastPage
            }
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
    taxonomiesQuery
}
