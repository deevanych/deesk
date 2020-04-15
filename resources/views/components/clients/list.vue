<template>
    <div class="row mb-5">
        <div class="col block-header d-flex align-items-center">
            <h3 class="font-weight-bold d-inline-block mb-0">Клиенты</h3>
            <div class="inline-block ml-auto header-links">
                <a href="#">Все клиенты</a>
                <router-link :to="{name: 'def'}" class="button p-3 px-4 rounded-pill shadow-sm tonight">Создать заявку
                </router-link>
            </div>
        </div>
        <div class="col-12 block-content">
            <div class="row">
                <div class="col-4">
                    <a class="client rounded-lg"
                       href="#">
                        <span class="client-background rounded-lg"></span>
                        <span class="client-title">Окинава</span>
                        <span class="client-description">13 заявок</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
