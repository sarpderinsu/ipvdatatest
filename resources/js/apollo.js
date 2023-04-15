import {ApolloClient, createHttpLink, InMemoryCache} from "@apollo/client/core";
import {setContext} from "@apollo/client/link/context";

const httpLink = createHttpLink({uri: API_URL})

export default new ApolloClient({
    link: authLink.concat(httpLink),
    cache: new InMemoryCache(),
})
