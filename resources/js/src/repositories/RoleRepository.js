import Request from '../services/RequestClient';

const resource = '/role';

export default {
    getAll(){
        return Request.get(`${resource}/`);
    },

    restore(id){
        return Request.get(`${resource}/restore/${id}`);
    },

    recycleBin(){
        return Request.get(`${resource}/recycle-bin`);
    },

    getById(id){
        return Request.get(`${resource}/${id}`);
    },

    disable(id){
        return Request.get(`${resource}/disable/${id}`);
    },

    create(data){
        return Request.post(`${resource}/`, data);
    },

    update(data, id){
        return Request.put(`${resource}/${id}`, data);
    },

    delete(id){
        return Request.delete(`${resource}/${id}`);
    }
}