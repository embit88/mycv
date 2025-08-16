import type { NextRequest } from 'next/server'
import { i18nRouter } from 'next-i18n-router';
import { NextResponse } from "next/server";
import appConfig from "@/appConfig";

export function middleware(request: NextRequest | any) {
    const { pathname } = request.nextUrl;

    const locale = pathname.split('/')[1];

    if(appConfig.locales.includes(locale)) {
        request.headers.set('x-current-locale', locale);
    }

    if (!appConfig.locales.includes(locale)) {
        const url = new URL(`/${appConfig.defaultLocale}${pathname}`, request.url);

        const response = NextResponse.rewrite(url);

        response.headers.set('x-current-locale', appConfig.defaultLocale);

        return response;
    }

    return i18nRouter(request, appConfig);
}

export const config = {
    matcher: '/((?!api|static|.*\\..*|_next).*)'
};
