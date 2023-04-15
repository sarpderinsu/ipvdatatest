import gql from 'graphql-tag'

const albertHeijnProducts = gql`
    query AlbertHeijnProducts {
        albertHeijnProducts {
            data {
                id
                taxonomy_slug
                created_at
                updated_at
            }
        }
    }`

const albertHeijnTaxonomySlugs = gql`
    query AlbertHeijnTaxonomySlugs {
        albertHeijnTaxonomySlugs {
            data {
                slug
            }
        }
    }`

export {
    albertHeijnProducts,
    albertHeijnTaxonomySlugs
}
