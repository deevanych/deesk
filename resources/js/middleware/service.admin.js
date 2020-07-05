export default function service_admin(next, user){
    if (Vue.prototype.$user.role.slug === 'service.admin'){
        return next();
    }
    console.log('Нет прав');
    return next();
}
