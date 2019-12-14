import { combineReducers } from 'redux';
import academies from "./academies";
import filters from "./filters";

export default combineReducers({
    academies,
    filters
});